<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be valid',
    '{{name}} must be invalid',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} is invalid',
    '{{name}} is valid',
    self::TEMPLATE_SIMPLE,
)]
final class AlwaysInvalid extends Simple
{
    public const TEMPLATE_SIMPLE = '__simple__';

    public function isValid(mixed $input): bool
    {
        return false;
    }
}
