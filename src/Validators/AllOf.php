<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Helpers\CanEvaluateShortCircuit;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Core\LogicalComposite;
use Respect\Validation\Validators\Core\ShortCircuitable;

use function array_filter;
use function array_map;
use function array_reduce;
use function count;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must pass the rules',
    '{{subject}} must pass the rules',
    self::TEMPLATE_SOME,
)]
#[Template(
    '{{subject}} must pass all the rules',
    '{{subject}} must pass all the rules',
    self::TEMPLATE_ALL,
)]
final class AllOf extends LogicalComposite implements ShortCircuitable
{
    use CanEvaluateShortCircuit;

    public const string TEMPLATE_ALL = '__all__';
    public const string TEMPLATE_SOME = '__some__';

    public function evaluate(mixed $input): Result
    {
        $children = array_map(static fn(Validator $validator) => $validator->evaluate($input), $this->validators);
        $valid = array_reduce($children, static fn(bool $carry, Result $result) => $carry && $result->hasPassed, true);
        $failed = array_filter($children, static fn(Result $result): bool => !$result->hasPassed);
        $template = self::TEMPLATE_SOME;
        if (count($children) === count($failed)) {
            $template = self::TEMPLATE_ALL;
        }

        return Result::of($valid, $input, $this, [], $template)->withChildren(...$children);
    }

    public function evaluateShortCircuit(mixed $input): Result
    {
        $children = [];
        foreach ($this->validators as $validator) {
            $result = $this->evaluateShortCircuitWith($validator, $input);
            $children[] = $result;
            if (!$result->hasPassed) {
                return $result;
            }
        }

        return Result::passed($input, $this, [], self::TEMPLATE_ALL)->withChildren(...$children);
    }
}
