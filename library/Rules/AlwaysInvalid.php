<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

final class AlwaysInvalid extends AbstractRule
{
    public const TEMPLATE_SIMPLE = 'simple';

    public function validate(mixed $input): bool
    {
        return false;
    }
}
