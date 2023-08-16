<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

/**
 * Validates whether the input is greater than or equal to a value.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Min extends AbstractComparison
{
    /**
     * {@inheritDoc}
     */
    protected function compare($left, $right): bool
    {
        return $left >= $right;
    }
}
