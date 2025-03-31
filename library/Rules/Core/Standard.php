<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Rule;
use Respect\Validation\Validator;

abstract class Standard implements Rule
{
    /**
     * @deprecated Calling `validate()` directly is deprecated, please use the `Validator::isValid()` class instead.
     */
    public function validate(mixed $input): bool
    {
        return $this->evaluate($input)->hasPassed;
    }

    /**
     * @deprecated Calling `assert()` directly is deprecated, please use the `Validator::assert()` instead.
     */
    public function assert(mixed $input): void
    {
        Validator::create($this)->assert($input);
    }

    /**
     * @deprecated Calling `check()` directly is deprecated, please use the `Validator::assert()` instead.
     */
    public function check(mixed $input): void
    {
        Validator::create($this)->assert($input);
    }
}
