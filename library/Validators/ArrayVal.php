<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
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
