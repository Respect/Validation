<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;

#[Template(
    '{{name}} is always invalid',
    '{{name}} is always valid',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{name}} is not valid',
    '{{name}} is valid',
    self::TEMPLATE_SIMPLE,
)]
final class AlwaysInvalid extends Simple
{
    public const TEMPLATE_SIMPLE = '__simple__';

    public function validate(mixed $input): bool
    {
        return false;
    }
}
