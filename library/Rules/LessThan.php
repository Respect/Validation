<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

/**
 * Validates whether the input is less than a value.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LessThan extends AbstractComparison
{
    /**
     * {@inheritDoc}
     */
    protected function compare($left, $right): bool
    {
        return $left < $right;
    }
}
