<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

/**
 * Validates whether the input is greater than or equal to a value.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class Min extends AbstractComparison
{
    /**
     * {@inheritDoc}
     */
    protected function compare($left, $right): bool
    {
        return $left >= $right;
    }
}
