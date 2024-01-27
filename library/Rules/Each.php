<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\EachException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Helpers\CanValidateIterable;
use Respect\Validation\Validatable;

final class Each extends AbstractRule
{
    use CanValidateIterable;

    public function __construct(private Validatable $rule)
    {
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
