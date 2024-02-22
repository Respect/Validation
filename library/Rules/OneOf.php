<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;

use function array_map;
use function array_reduce;

#[Template(
    'Only one of these rules must pass for {{name}}',
    'Only one of these rules must not pass for {{name}}',
)]
final class OneOf extends Composite
{
    public function evaluate(mixed $input): Result
    {
        $children = array_map(static fn (Rule $rule) => $rule->evaluate($input), $this->getRules());
        $count = array_reduce($children, static fn (int $carry, Result $result) => $carry + (int) $result->isValid, 0);

        return (new Result($count === 1, $input, $this))->withChildren(...$children);
    }
}
