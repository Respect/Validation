<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Rules\AbstractRule;

abstract class Simple extends AbstractRule
{
    abstract public function isValid(mixed $input): bool;

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        return $this->isValid($input);
    }
}
