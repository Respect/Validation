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
use function usort;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must pass one of the rules',
    '{{subject}} must pass one of the rules',
    self::TEMPLATE_NONE,
)]
#[Template(
    '{{subject}} must pass only one of the rules',
    '{{subject}} must pass only one of the rules',
    self::TEMPLATE_MORE_THAN_ONE,
)]
final class OneOf extends Composite
{
    public const string TEMPLATE_NONE = '__none__';
    public const string TEMPLATE_MORE_THAN_ONE = '__more_than_one__';

    public function evaluate(mixed $input): Result
    {
        $children = array_map(static fn(Rule $rule) => $rule->evaluate($input), $this->rules);
        $valid = array_reduce(
            $children,
            static fn(bool $carry, Result $result) => $carry xor $result->hasPassed,
            false,
        );
        $validChildren = array_filter($children, static fn(Result $result): bool => $result->hasPassed);
        $template = self::TEMPLATE_NONE;
        if (count($validChildren) > 1) {
            // Put the failed children at the top, so it makes sense in the main error message
            usort($children, static fn(Result $a, Result $b): int => $a->hasPassed <=> $b->hasPassed);

            $template = self::TEMPLATE_MORE_THAN_ONE;
            $children = array_map(
                static fn(Result $child) => $child->hasPassed ? $child->withToggledValidation() : $child,
                $children,
            );
        }

        return Result::of($valid, $input, $this, [], $template)->withChildren(...$children);
    }
}
