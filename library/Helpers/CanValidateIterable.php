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

use stdClass;
use Traversable;
use function is_array;

/**
 * Helper to handle iterable values.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
trait CanValidateIterable
{
    /**
     * Returns whether the value is iterable or not.
     *
     * @param mixed $value
     */
    public function isIterable($value): bool
    {
        return is_array($value) || $value instanceof stdClass || $value instanceof Traversable;
    }
}
