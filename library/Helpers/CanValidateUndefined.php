<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use function in_array;

/**
 * Helper to identify values that Validation consider as "undefined".
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
trait CanValidateUndefined
{
    /**
     * Finds whether the value is undefined or not.
     *
     * @param mixed $value
     */
    private function isUndefined($value): bool
    {
        return in_array($value, [null, ''], true);
    }
}
