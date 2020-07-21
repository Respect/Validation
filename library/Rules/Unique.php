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

namespace Respect\Validation\Rules;

use function array_unique;
use function is_array;

use const SORT_REGULAR;

/**
 * Validates whether the input array contains only unique values.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Krzysztof Śmiałek <admin@avensome.net>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class Unique extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_array($input)) {
            return false;
        }

        return $input == array_unique($input, SORT_REGULAR);
    }
}
