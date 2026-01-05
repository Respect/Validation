<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be valid',
    '{{subject}} must be invalid',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} is invalid',
    '{{subject}} is valid',
    self::TEMPLATE_SIMPLE,
)]
final class AlwaysInvalid extends Simple
{
    public const string TEMPLATE_SIMPLE = '__simple__';

    public function isValid(mixed $input): bool
    {
        return false;
    }
}
