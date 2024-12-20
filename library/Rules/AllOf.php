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
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Composite;

use function array_filter;
use function array_map;
use function array_reduce;
use function count;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    'These rules must pass for {{name}}',
    'These rules must not pass for {{name}}',
    self::TEMPLATE_SOME,
)]
#[Template(
    'All the required rules must pass for {{name}}',
    'None of these rules must pass for {{name}}',
    self::TEMPLATE_NONE,
)]
final class AllOf extends Composite
{
    public const TEMPLATE_NONE = '__none__';
    public const TEMPLATE_SOME = '__some__';

    public function evaluate(mixed $input): Result
    {
        $children = array_map(static fn (Rule $rule) => $rule->evaluate($input), $this->rules);
        $valid = array_reduce($children, static fn (bool $carry, Result $result) => $carry && $result->isValid, true);
        $failed = array_filter($children, static fn (Result $result): bool => !$result->isValid);
        $template = self::TEMPLATE_SOME;
        if (count($children) === count($failed)) {
            $template = self::TEMPLATE_NONE;
        }

        return (new Result($valid, $input, $this, [], $template))->withChildren(...$children);
    }
}
