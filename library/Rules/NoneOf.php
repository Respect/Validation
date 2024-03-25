<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Composite;
use Respect\Validation\Validatable;

use function array_map;
use function array_reduce;

#[Template(
    'None of these rules must pass for {{name}}',
    'All of these rules must pass for {{name}}',
)]
final class NoneOf extends Composite
{
    public function evaluate(mixed $input): Result
    {
        $children = array_map(
            static fn (Validatable $rule) => $rule->evaluate($input)->withInvertedMode(),
            $this->rules
        );
        $valid = array_reduce($children, static fn (bool $carry, Result $result) => $carry && $result->isValid, true);

        return (new Result($valid, $input, $this))->withChildren(...$children);
    }
}
