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
    '{{name}} is always valid',
    '{{name}} is always invalid',
)]
final class AlwaysValid extends Simple
{
    protected function isValid(mixed $input): bool
    {
        return true;
    }
}
