<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Validators\Core;

use Respect\Validation\Result;
use Respect\Validation\Validators\Core\FilteredNonEmptyArray;

final class ConcreteFilteredNonEmptyArray extends FilteredNonEmptyArray
{
    /** @param non-empty-array<mixed> $input */
    protected function evaluateNonEmptyArray(array $input): Result
    {
        return $this->validator->evaluate($input);
    }
}
