<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Validators\Core;

use Respect\Validation\Result;
use Respect\Validation\Validators\Core\LogicalComposite;

final class ConcreteLogicalComposite extends LogicalComposite
{
    public function evaluate(mixed $input): Result
    {
        return Result::passed($input, $this);
    }
}
