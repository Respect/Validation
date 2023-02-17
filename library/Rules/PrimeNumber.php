<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function ceil;
use function is_numeric;
use function sqrt;

/**
 * Validates whether the input is a prime number.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Camilo Teixeira de Melo <kmilotxm@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ismael Elias <ismael.esq@hotmail.com>
 * @author Kleber Hamada Sato <kleberhs007@yahoo.com>
 */
final class PrimeNumber extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_numeric($input) || $input <= 1) {
            return false;
        }

        if ($input != 2 && ($input % 2) == 0) {
            return false;
        }

        for ($i = 3; $i <= ceil(sqrt((float) $input)); $i += 2) {
            if ($input % $i == 0) {
                return false;
            }
        }

        return true;
    }
}
