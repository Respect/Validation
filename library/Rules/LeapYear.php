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

namespace Respect\Validation\Rules;

use DateTimeInterface;

class LeapYear extends AbstractRule
{
    public function validate($year)
    {
        if (is_numeric($year)) {
            $year = (int) $year;
        } elseif (is_string($year)) {
            $year = (int) date('Y', (int) strtotime($year));
        } elseif ($year instanceof DateTimeInterface) {
            $year = (int) $year->format('Y');
        } else {
            return false;
        }

        $date = strtotime(sprintf('%d-02-29', $year));

        return (bool) date('L', (int) $date);
    }
}
