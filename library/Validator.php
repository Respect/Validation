<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Exceptions\ValidatorException;
use Respect\Validation\Helpers\CanBindEvaluateRule;
use Respect\Validation\Message\Formatter;
use Respect\Validation\Message\StandardFormatter;
use Respect\Validation\Message\StandardRenderer;
use Respect\Validation\Mixins\StaticValidator;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Rules\AllOf;

use function count;
use function current;

/**
 * @mixin StaticValidator
 */
final class Validator extends AbstractRule
{
    use CanBindEvaluateRule;

    /** @var array<Validatable> */
    private array $rules = [];

    /** @var array<string, mixed> */
    private array $templates = [];

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

    public function validate(mixed $input): bool
    {
        return $this->evaluate($input)->isValid;
    }

    public function assert(mixed $input): void
    {
        $result = $this->evaluate($input);
        if ($result->isValid) {
            return;
        }

        $templates = $this->templates;
        if (count($templates) === 0 && $this->template != null) {
            $templates = ['__self__' => $this->template];
        }

        throw new ValidatorException(
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
