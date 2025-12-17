<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Rules\Core;

use Respect\Validation\Rules\Core\FilteredString;

final class ConcreteFilteredString extends FilteredString
{
    public string|null $lastFilteredInput = null;

    protected function isValid(string $input): bool
    {
        $this->lastFilteredInput = $input;

        return true;
    }
}
