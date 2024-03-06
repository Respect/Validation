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
use Respect\Validation\Rules\Core\Composite;

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
        $children = array_map(static fn (Rule $rule) => $rule->evaluate($input), $this->rules);
        $valid = array_reduce($children, static fn (bool $carry, Result $result) => $carry xor $result->isValid, false);

        return (new Result($valid, $input, $this))->withChildren(...$children);
    }
}
