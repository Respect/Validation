<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

/**
 * Validates the given input with a defined rule when input is not NULL.
 *
 * @author Jens Segers <segers.jens@gmail.com>
 */
final class Nullable extends AbstractWrapper
{
    /**
     * @deprecated Calling `assert()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::assert()} instead.
     */
    public function assert($input): void
    {
        if ($input === null) {
            return;
        }

        parent::assert($input);
    }

    /**
     * @deprecated Calling `check()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::check()} instead.
     */
    public function check($input): void
    {
        if ($input === null) {
            return;
        }

        parent::check($input);
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if ($input === null) {
            return true;
        }

        return parent::validate($input);
    }
}
