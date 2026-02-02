<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Ismael Elias <ismael.esq@hotmail.com>
 * SPDX-FileContributor: Krzysztof Śmiałek <admin@avensome.net>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Vitaliy <reboot.m@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function is_nan;
use function is_numeric;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a number',
    '{{subject}} must not be a number',
)]
final class Number extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        return !is_nan((float) $input);
    }
}
