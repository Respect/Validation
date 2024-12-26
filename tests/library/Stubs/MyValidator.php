<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator;
use Respect\Validation\ValidatorDefaults;

final class MyValidator
{
    public static function assertIntType(mixed $input): void
    {
        $originalIgnoredBacktracePaths = ValidatorDefaults::getIgnoredBacktracePaths();
        ValidatorDefaults::setIgnoredBacktracePaths(__FILE__, ...$originalIgnoredBacktracePaths);
        try {
            Validator::intType()->assert($input);
        } catch (ValidationException $exception) {
            // This is a workaround to avoid changing exceptions that are thrown in other places.
            ValidatorDefaults::setIgnoredBacktracePaths(...$originalIgnoredBacktracePaths);
            throw $exception;
        }
    }
}
