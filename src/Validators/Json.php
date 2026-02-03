<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Ayesh Karunaratne
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
 * SPDX-FileContributor: Emerson Carvalho <emerson.broga@gmail.com>
 * SPDX-FileContributor: Emmerson <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jair Henrique <jair.henrique@gmail.com>
 * SPDX-FileContributor: Kir Kolyshkin <kolyshkin@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

use function is_string;
use function json_validate;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid JSON string',
    '{{subject}} must not be a valid JSON string',
)]
final class Json extends Simple
{
    public function isValid(mixed $input): bool
    {
        if (!is_string($input) || $input === '') {
            return false;
        }

        return json_validate($input);
    }
}
