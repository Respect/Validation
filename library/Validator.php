<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Message\ArrayFormatter;
use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\StringFormatter;
use Respect\Validation\Mixins\Builder;
use Respect\Validation\Rules\AllOf;
use Respect\Validation\Rules\Core\Nameable;
use Throwable;

use function count;
use function current;
use function is_array;
use function is_callable;
use function is_string;

/** @mixin Builder */
final class Validator implements Rule, Nameable
{
    /** @var array<Rule> */
    private array $rules = [];

    /** @param array<string> $ignoredBacktracePaths */
    public function __construct(
        private readonly RuleFactory $ruleFactory,
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
        $rule = match (count($this->rules)) {
            0 => throw new ComponentException('No rules have been added to this validator.'),
            1 => current($this->rules),
            default => new AllOf(...$this->rules),
        };

        return $rule->evaluate($input);
    }

    /** @param array<string|int, mixed>|string|null $template */
    public function validate(mixed $input, array|string|null $template = null): ResultQuery
    {
        return $this->toResultQuery($this->evaluate($input), $template);
    }

    public function isValid(mixed $input): bool
    {
        return $this->evaluate($input)->hasPassed;
    }

    /** @param array<string|int, mixed>|callable(ValidationException): Throwable|string|Throwable|null $template */
    public function assert(mixed $input, array|string|Throwable|callable|null $template = null): void
    {
        $result = $this->evaluate($input);
        if ($result->hasPassed) {
            return;
        }

        if ($template instanceof Throwable) {
            throw $template;
        }

        $resultQuery = $this->toResultQuery($result, is_callable($template) ? null : $template);

        $exception = new ValidationException(
            $resultQuery->toMessage(),
            $resultQuery->toFullMessage(),
            $resultQuery->toArrayMessages(),
            $this->ignoredBacktracePaths,
        );

        if (is_callable($template)) {
            throw $template($exception);
        }

        throw $exception;
    }

    public function addRule(Rule $rule): self
    {
        $this->rules[] = $rule;

        return $this;
    }

    /** @return array<Rule> */
    public function getRules(): array
    {
        return $this->rules;
    }

    public function getName(): Name|null
    {
        if (count($this->rules) === 1 && current($this->rules) instanceof Nameable) {
            return current($this->rules)->getName();
        }

        return null;
    }

    /** @param array<string|int, mixed>|string|null $template */
    private function toResultQuery(Result $result, array|string|null $template): ResultQuery
    {
        return new ResultQuery(
            $this->resultFilter->filter(is_string($template) ? $result->withTemplate($template) : $result),
            $this->renderer,
            $this->mainMessageFormatter,
            $this->fullMessageFormatter,
            $this->messagesFormatter,
            is_array($template) ? $template : [],
        );
    }

    /** @param mixed[] $arguments */
    public static function __callStatic(string $ruleName, array $arguments): self
    {
        return self::create()->__call($ruleName, $arguments);
    }

    /** @param mixed[] $arguments */
    public function __call(string $ruleName, array $arguments): self
    {
        return $this->addRule($this->ruleFactory->create($ruleName, $arguments));
    }
}
