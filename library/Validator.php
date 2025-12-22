<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Message\ArrayFormatter;
use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\StringFormatter;
use Respect\Validation\Mixins\Builder;
use Respect\Validation\Rules\Core\Nameable;
use Respect\Validation\Rules\Core\Reducer;
use Throwable;

use function is_array;
use function is_callable;
use function is_string;

/** @mixin Builder */
final class Validator implements Rule, Nameable
{
    /** @var array<Rule> */
    private array $rules = [];

    /** @var array<string|int, mixed> */
    private array $templates = [];

    private Name|null $name = null;

    private string|null $template = null;

    /** @param array<string> $ignoredBacktracePaths */
    public function __construct(
        private readonly Factory $factory,
        private readonly Renderer $renderer,
        private readonly StringFormatter $mainMessageFormatter,
        private readonly StringFormatter $fullMessageFormatter,
        private readonly ArrayFormatter $messagesFormatter,
        private readonly ResultFilter $resultFilter,
        private readonly array $ignoredBacktracePaths,
    ) {
    }

    public static function create(Rule ...$rules): self
    {
        $validator = ContainerRegistry::getContainer()->get(ValidatorFactory::class)->create();
        $validator->rules = $rules;

        return $validator;
    }

    public function evaluate(mixed $input): Result
    {
        return $this->getRule()->evaluate($input);
    }

    public function isValid(mixed $input): bool
    {
        return $this->evaluate($input)->hasPassed;
    }

    /** @param array<string, mixed>|callable(ValidationException): Throwable|string|Throwable|null $template */
    public function assert(mixed $input, array|string|Throwable|callable|null $template = null): void
    {
        $result = $this->evaluate($input);
        if ($result->hasPassed) {
            return;
        }

        if ($template instanceof Throwable) {
            throw $template;
        }

        $failedResult = $this->resultFilter->filter($result);

        $templates = $this->templates;
        if (is_array($template)) {
            $templates = $template;
        } elseif (is_string($template)) {
            $failedResult = $failedResult->withTemplate($template);
        } elseif ($this->getTemplate() != null) {
            $failedResult = $failedResult->withTemplate($this->getTemplate());
        }

        $exception = new ValidationException(
            $this->mainMessageFormatter->format($failedResult, $this->renderer, $templates),
            $this->fullMessageFormatter->format($failedResult, $this->renderer, $templates),
            $this->messagesFormatter->format($failedResult, $this->renderer, $templates),
            $this->ignoredBacktracePaths,
        );

        if (!is_callable($template)) {
            throw $exception;
        }

        throw $template($exception);
    }

    /** @param array<string|int, mixed> $templates */
    public function setTemplates(array $templates): self
    {
        $this->templates = $templates;

        return $this;
    }

    public function addRule(Rule $rule): self
    {
        $this->rules[] = $rule;

        return $this;
    }

    public function getRule(): Reducer
    {
        $reducer = new Reducer(...$this->rules);
        if ($this->name !== null) {
            $reducer = $reducer->withName($this->name);
        }

        if ($this->template !== null) {
            $reducer = $reducer->withTemplate($this->template);
        }

        return $reducer;
    }

    /** @return array<Rule> */
    public function getRules(): array
    {
        return $this->rules;
    }

    public function getName(): Name|null
    {
        return $this->getRule()->getName() ?? $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = new Name($name);

        return $this;
    }

    public function getTemplate(): string|null
    {
        return $this->template;
    }

    public function setTemplate(string $template): static
    {
        $this->template = $template;

        return $this;
    }

    /** @param mixed[] $arguments */
    public static function __callStatic(string $ruleName, array $arguments): self
    {
        return self::create()->__call($ruleName, $arguments);
    }

    /** @param mixed[] $arguments */
    public function __call(string $ruleName, array $arguments): self
    {
        return $this->addRule($this->factory->rule($ruleName, $arguments));
    }
}
