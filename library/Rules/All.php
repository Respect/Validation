<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\FilteredNonEmptyArray;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template('Every item in', 'Every item in')]
final class All extends FilteredNonEmptyArray
{
    /** @param non-empty-array<mixed> $input */
    protected function evaluateNonEmptyArray(array $input): Result
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
