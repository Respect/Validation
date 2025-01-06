<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanValidateIterable;

/**
 * Validates whether the pseudo-type of the input is iterable or not.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class IterableType extends AbstractRule
{
    use CanValidateIterable;

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        return $this->isIterable($input);
    }
}
