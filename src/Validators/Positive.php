<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Ismael Elias <ismael.esq@hotmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Fluent\Attributes\Assurance;
use Respect\Fluent\Attributes\Composable;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function is_numeric;

#[Composable(with: [Length::class, Max::class, Min::class])]
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a positive number',
    '{{subject}} must not be a positive number',
)]
#[Assurance(type: 'int|float|numeric-string')]
final class Positive extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        return $input > 0;
    }
}
