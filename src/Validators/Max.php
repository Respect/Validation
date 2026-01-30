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

use function max;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template('The maximum of', 'The maximum of')]
final class Max extends FilteredArray
{
    /** @param non-empty-array<mixed> $input */
    protected function evaluateArray(array $input): Result
    {
        $result = $this->validator->evaluate(max($input));

        return $result->asAdjacentOf(
            Result::of($result->hasPassed, $input, $this),
            'max',
        );
    }
}
