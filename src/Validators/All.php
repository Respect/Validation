<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Dominick Johnson
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validators\Core\FilteredArray;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template('Every item in', 'Every item in')]
final class All extends FilteredArray
{
    /** @param non-empty-array<mixed> $input */
    protected function evaluateArray(array $input): Result
    {
        $result = null;
        $hasPassed = true;
        foreach ($input as $value) {
            $result = $this->validator->evaluate($value);
            if ($result->hasPassed === false) {
                $hasPassed = false;
                break;
            }
        }

        return $result->asAdjacentOf(
            Result::of($hasPassed, $input, $this),
            'all',
        );
    }
}
