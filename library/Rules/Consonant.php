<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function preg_match;

final class Consonant extends AbstractFilterRule
{
    protected function validateFilteredInput(string $input): bool
    {
        return preg_match('/^(\s|[b-df-hj-np-tv-zB-DF-HJ-NP-TV-Z])*$/', $input) > 0;
    }
}
