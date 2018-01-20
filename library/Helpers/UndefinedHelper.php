<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

/**
 * Helper to identify values that Validation consider as "undefined".
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
trait UndefinedHelper
{
    /**
     * Finds whether the value is undefined or not.
     *
     * @param mixed $value
     *
     * @return bool
     */
    private function isUndefined($value): bool
    {
        return in_array($value, [null, ''], true);
    }
}
