<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\Template;

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
final class AlwaysInvalid extends AbstractRule
{
    public const TEMPLATE_SIMPLE = 'simple';

    public function validate(mixed $input): bool
    {
        return false;
    }
}
