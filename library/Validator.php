<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Helpers\CanBindEvaluateRule;
use Respect\Validation\Message\Formatter;
use Respect\Validation\Message\StandardFormatter;
use Respect\Validation\Message\StandardRenderer;
use Respect\Validation\Mixins\StaticValidator;
use Respect\Validation\Rules\AllOf;
use Throwable;

use function count;
use function current;
use function is_array;
use function is_string;

/**
 * @mixin StaticValidator
 */
final class Validator implements Validatable
{
    use CanBindEvaluateRule;

    /** @var array<Validatable> */
    private array $rules = [];

    /** @var array<string, mixed> */
    private array $templates = [];

    private ?string $name = null;

    private ?string $template = null;

    public function __construct(
        private readonly Factory $factory,
        private readonly Formatter $formatter,
    ) {
    }

    public static function create(Validatable ...$rules): self
    {
        $validator = new self(
            Factory::getDefaultInstance(),
            new StandardFormatter(
                new StandardRenderer(
                    Factory::getDefaultInstance()->getTranslator(),
                    Factory::getDefaultInstance()->getParameterProcessor(),
                )
            )
        );
        $validator->rules = $rules;

        return $validator;
    }

    public function evaluate(mixed $input): Result
    {
        return $this->bindEvaluate($this->rule(), $this, $input);
    }

    public function isValid(mixed $input): bool
    {
        return $this->evaluate($input)->isValid;
    }

    /** @param array<string, mixed>|string|Throwable|null $template */
    public function assert(mixed $input, array|string|Throwable|null $template = null): void
    {
        $result = $this->evaluate($input);
        if ($result->isValid) {
            return;
        }

        if ($template instanceof Throwable) {
            throw $template;
        }

        $templates = $this->templates;
        if (is_array($template)) {
            $templates = $template;
        } elseif (is_string($template)) {
            $templates = ['__root__' => $template];
        } elseif ($this->getTemplate() != null) {
            $templates = ['__root__' => $this->getTemplate()];
        }

        throw new ValidationException(
            $this->formatter->main($result, $templates),
            $this->formatter->full($result, $templates),
            $this->formatter->array($result, $templates),
        );
    }

    /** @param array<string, mixed> $templates */
    public function setTemplates(array $templates): self
    {
        $this->templates = $templates;

        return $this;
    }

    /** @return array<Validatable> */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @deprecated Use {@see isValid()} instead.
     */
    public function validate(mixed $input): bool
    {
        return $this->evaluate($input)->isValid;
    }

    /**
     * @deprecated Use {@see assert()} instead.
     */
    public function check(mixed $input): void
    {
        $this->assert($input);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(string $template): static
    {
        $this->template = $template;

        return $this;
    }

    private function rule(): Validatable
    {
        if (count($this->rules) === 1) {
            return current($this->rules);
        }

        return new AllOf(...$this->rules);
    }

    /**
     * @param mixed[] $arguments
     */
    public static function __callStatic(string $ruleName, array $arguments): self
    {
        return self::create()->__call($ruleName, $arguments);
    }

    /**
     * @param mixed[] $arguments
     */
    public function __call(string $ruleName, array $arguments): self
    {
        $this->rules[] = $this->factory->rule($ruleName, $arguments);

        return $this;
    }
}
