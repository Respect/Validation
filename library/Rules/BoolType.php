<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_bool;

/**
 * Validates whether the type of the input is boolean.
 *
 * @author Devin Torres <devin@devintorres.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BoolType extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        return is_bool($input);
    }
}
