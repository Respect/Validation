<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Andre Ramaciotti <andre@ramaciotti.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\FilteredString;

use function ctype_digit;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must contain only digits (0-9)',
    '{{subject}} must not contain digits (0-9)',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must contain only digits (0-9) and {{additionalChars}}',
    '{{subject}} must not contain digits (0-9) and {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Digit extends FilteredString
{
    protected function isValid(string $input): bool
    {
        return ctype_digit($input);
    }
}
