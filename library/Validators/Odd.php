<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
 * SPDX-FileContributor: Devin Torres <devin@devintorres.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jean Pimentel <jeanfap@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function filter_var;
use function is_numeric;

use const FILTER_VALIDATE_INT;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be an odd number',
    '{{subject}} must be an even number',
)]
final class Odd extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        if (!filter_var($input, FILTER_VALIDATE_INT)) {
            return false;
        }

        return (int) $input % 2 !== 0;
    }
}
