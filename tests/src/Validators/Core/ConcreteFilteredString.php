<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Validators\Core;

use Respect\Validation\Validators\Core\FilteredString;

final class ConcreteFilteredString extends FilteredString
{
    public string|null $lastFilteredInput = null;

    protected function isValid(string $input): bool
    {
        $this->lastFilteredInput = $input;

        return true;
    }
}
