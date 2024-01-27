<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function preg_match;

final class Vowel extends AbstractFilterRule
{
    protected function validateFilteredInput(string $input): bool
    {
        return preg_match('/^[aeiouAEIOU]+$/', $input) > 0;
    }
}
