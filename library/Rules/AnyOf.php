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
use Respect\Validation\Rules\Core\Composite;
use Respect\Validation\Validator;

use function array_map;
use function array_reduce;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must pass at least one of the rules',
    '{{subject}} must pass at least one of the rules',
)]
final class AnyOf extends Composite
{
    public function evaluate(mixed $input): Result
    {
        $children = array_map(static fn(Validator $validator) => $validator->evaluate($input), $this->validators);
        $valid = array_reduce(
            $children,
            static fn(bool $carry, Result $result) => $carry || $result->hasPassed,
            false,
        );

        return Result::of($valid, $input, $this)->withChildren(...$children);
    }
}
