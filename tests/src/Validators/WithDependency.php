<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Validators;

use Respect\Validation\Validators\Core\Simple;
use stdClass;

final class WithDependency extends Simple
{
    public function __construct(public readonly stdClass $dependency)
    {
    }

    public function isValid(mixed $input): bool
    {
        return true;
    }
}
