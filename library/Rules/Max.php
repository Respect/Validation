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

use function max;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template('The maximum of', 'The maximum of')]
final class Max extends FilteredNonEmptyArray
{
    /** @param non-empty-array<mixed> $input */
    protected function evaluateNonEmptyArray(array $input): Result
    {
        $result = $this->validator->evaluate(max($input));

        return $result->asAdjacentOf(
            Result::of($result->hasPassed, $input, $this),
            'max',
        );
    }
}
