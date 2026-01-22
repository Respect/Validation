<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexander Wühr <l-x@mailbox.org>
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Camilo Teixeira de Melo
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Ismael Elias <ismael.esq@hotmail.com>
 * SPDX-FileContributor: Kleber Hamada Sato <kleberhs007@yahoo.com>
 * SPDX-FileContributor: kmilotxm@gmail.com <kmilotxm@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function ceil;
use function is_numeric;
use function sqrt;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a prime number',
    '{{subject}} must not be a prime number',
)]
final class PrimeNumber extends Simple
{
    public function isValid(mixed $input): bool
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
