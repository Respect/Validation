<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\ExceptionClass;
use Respect\Validation\Exceptions\EachException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Helpers\CanValidateIterable;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validatable;

#[ExceptionClass(EachException::class)]
#[Template(
    'Each item in {{name}} must be valid',
    'Each item in {{name}} must not validate',
)]
final class Each extends AbstractRule
{
    use CanValidateIterable;

    public function __construct(
        private readonly Validatable $rule
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        if (!$this->isIterable($input)) {
            return Result::failed($input, $this);
        }

        $children = [];
        $isValid = true;
        foreach ($input as $inputItem) {
            $childResult = $this->rule->evaluate($inputItem);
            $isValid = $isValid && $childResult->isValid;
            $children[] = $childResult;
        }

        if ($isValid) {
            return Result::passed($input, $this)->withChildren(...$children);
        }

        return Result::failed($input, $this)->withChildren(...$children);
    }

    public function assert(mixed $input): void
    {
        if (!$this->isIterable($input)) {
            throw $this->reportError($input);
        }

        $exceptions = [];
        foreach ($input as $value) {
            try {
                $this->rule->assert($value);
            } catch (ValidationException $exception) {
                $exceptions[] = $exception;
            }
        }

        if (!empty($exceptions)) {
            /** @var EachException $eachException */
            $eachException = $this->reportError($input);
            $eachException->addChildren($exceptions);

            throw $eachException;
        }
    }

    public function check(mixed $input): void
    {
        if (!$this->isIterable($input)) {
            throw $this->reportError($input);
        }

        foreach ($input as $value) {
            $this->rule->check($value);
        }
    }

    public function validate(mixed $input): bool
    {
        try {
            $this->check($input);
        } catch (ValidationException $exception) {
            return false;
        }

        return true;
    }
}
