<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Guilherme Siani <guilherme@siani.com.br>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: João Torquato <joao.otl@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use ArrayAccess;
use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;
use SimpleXMLElement;

use function is_array;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be an array value',
    '{{subject}} must not be an array value',
)]
final class ArrayVal extends Simple
{
    public function isValid(mixed $input): bool
    {
        return is_array($input) || $input instanceof ArrayAccess || $input instanceof SimpleXMLElement;
    }
}
