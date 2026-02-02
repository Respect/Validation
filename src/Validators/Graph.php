<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Andre Ramaciotti <andre@ramaciotti.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\FilteredString;

use function ctype_graph;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must consist only of printable non-spacing characters',
    '{{subject}} must not consist only of printable non-spacing characters',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must consist only of printable non-spacing characters or {{additionalChars}}',
    '{{subject}} must not consist only of printable non-spacing characters or {{additionalChars}}',
    self::TEMPLATE_EXTRA,
)]
final class Graph extends FilteredString
{
    protected function isValid(string $input): bool
    {
        return ctype_graph($input);
    }
}
