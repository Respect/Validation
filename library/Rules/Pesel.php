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

use function is_scalar;
use function preg_match;

/**
 * Validates PESEL (Polish human identification number).
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Tomasz Regdos <tomek@regdos.com>
 */
final class Pesel extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $stringInput = (string) $input;
        if (!preg_match('/^\d{11}$/', (string) $stringInput)) {
            return false;
        }

        $weights = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];

        $targetControlNumber = $stringInput[10];
        $calculateControlNumber = 0;

        for ($i = 0; $i < 10; ++$i) {
            $calculateControlNumber += $stringInput[$i] * $weights[$i];
        }

        $calculateControlNumber = (10 - $calculateControlNumber % 10) % 10;

        return $targetControlNumber == $calculateControlNumber;
    }
}
