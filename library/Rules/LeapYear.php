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
use function date;
use function is_numeric;
use function is_string;
use function sprintf;
use function strtotime;

/**
 * Validates if a year is leap.
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jayson Reis <santosdosreis@gmail.com>
 */
final class LeapYear extends AbstractRule
{
    /**
     * {@inheritdoc}
     */
    public function validate($year): bool
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
