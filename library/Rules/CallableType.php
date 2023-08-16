<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_callable;

/**
 * Validates whether the pseudo-type of the input is callable.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class CallableType extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        return is_callable($input);
    }
}
