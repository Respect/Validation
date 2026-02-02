<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jayson Reis <santosdosreis@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use DateTimeInterface;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function date;
use function is_numeric;
use function is_scalar;
use function sprintf;
use function strtotime;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a leap year',
    '{{subject}} must not be a leap year',
)]
final class LeapYear extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (is_numeric($input)) {
            $date = strtotime(sprintf('%d-02-29', (int) $input));

            return (bool) date('L', (int) $date);
        }

        if (is_scalar($input)) {
            return $this->isValid((int) date('Y', (int) strtotime((string) $input)));
        }

        if ($input instanceof DateTimeInterface) {
            return $this->isValid($input->format('Y'));
        }

        return false;
    }
}
