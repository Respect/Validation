<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Message\ArrayFormatter;
use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\StringFormatter;
use Respect\Validation\Mixins\Builder;
use Respect\Validation\Validators\AllOf;
use Respect\Validation\Validators\Core\Nameable;
use Throwable;

use function count;
use function current;
use function is_array;
use function is_callable;
use function is_string;

/** @mixin Builder */
final readonly class ValidatorBuilder implements Validator, Nameable
{
    /** @var array<Validator> */
    private array $validators;

    /** @param array<string> $ignoredBacktracePaths */
    public function __construct(
        private ValidatorFactory $validatorFactory,
        private Renderer $renderer,
        private StringFormatter $mainMessageFormatter,
        private StringFormatter $fullMessageFormatter,
        private ArrayFormatter $messagesFormatter,
        private ResultFilter $resultFilter,
        private array $ignoredBacktracePaths,
        Validator ...$validators,
    ) {
        $this->validators = $validators;
    }

    public static function init(Validator ...$validators): self
    {
        if ($validators === []) {
            return ContainerRegistry::getContainer()->get(self::class);
        }

        return ContainerRegistry::getContainer()->get(self::class)->with(...$validators);
    }

    public function evaluate(mixed $input): Result
    {
        return $this->getEvaluationTarget()->evaluate($input);
    }

    /** @param array<string|int, mixed>|string|null $template */
    public function validate(mixed $input, array|string|null $template = null): ResultQuery
    {
        return $this->toResultQuery($this->evaluate($input), $template);
    }

    public function isValid(mixed $input): bool
    {
        $validator = $this->getEvaluationTarget();

        if ($validator instanceof IsValid) {
            return $validator->isValid($input);
        }

        return $validator->evaluate($input)->hasPassed;
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

        $exception = new ValidationException($resultQuery->getMessage(), $resultQuery, ...$this->ignoredBacktracePaths);
        if (is_callable($template)) {
            throw $template($exception);
        }

        throw $exception;
    }

    public function with(Validator $validator, Validator ...$validators): self
    {
        return clone ($this, ['validators' => [...$this->validators, $validator, ...$validators]]);
    }

    /** @return array<Validator> */
    public function getValidators(): array
    {
        return $this->validators;
    }

    public function getName(): Name|null
    {
        if (count($this->validators) === 1 && current($this->validators) instanceof Nameable) {
            return current($this->validators)->getName();
        }

        return null;
    }

    private function getEvaluationTarget(): Validator
    {
        return match (count($this->validators)) {
            0 => throw new ComponentException('No validators have been added.'),
            1 => current($this->validators),
            default => new AllOf(...$this->validators),
        };
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

    /** @param array<int, mixed> $arguments */
    public static function __callStatic(string $ruleName, array $arguments): self
    {
        return self::init()->__call($ruleName, $arguments);
    }

    /** @param array<int, mixed> $arguments */
    public function __call(string $ruleName, array $arguments): self
    {
        return $this->with($this->validatorFactory->create($ruleName, $arguments));
    }
}
