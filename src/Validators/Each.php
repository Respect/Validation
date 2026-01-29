<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Dylan T <odigiman@gmail.com>
 * SPDX-FileContributor: Emmerson <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Path;
use Respect\Validation\Result;
use Respect\Validation\Validators\Core\FilteredNonEmptyArray;

use function array_reduce;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    'Each item in {{subject}} must be valid',
    'Each item in {{subject}} must be invalid',
)]
final class Each extends FilteredNonEmptyArray
{
    /** @param non-empty-array<mixed> $input */
    protected function evaluateNonEmptyArray(array $input): Result
    {
        $children = [];
        foreach ($input as $key => $value) {
            $children[] = $this->validator->evaluate($value)->withPath(new Path($key))->withPrecedentName(false);
        }

        $hasPassed = array_reduce(
            $children,
            static fn($carry, $childResult) => $carry && $childResult->hasPassed,
            true,
        );

        return Result::of($hasPassed, $input, $this)->withChildren(...$children);
    }
}
