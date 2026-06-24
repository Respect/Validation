<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Helpers\CanEvaluateShortCircuit;
use Respect\Validation\Message\Template;
use Respect\Validation\Path;
use Respect\Validation\Result;
use Respect\Validation\Validators\Core\FilteredArray;
use Respect\Validation\Validators\Core\ShortCircuitable;

use function array_keys;
use function array_reduce;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    'Each key of {{subject}} must be valid',
    'Each key of {{subject}} must be invalid',
    self::TEMPLATE_STANDARD,
)]
#[Template('Key', 'Key', self::TEMPLATE_NESTED)]
#[Template('Each key of', 'Each key of', self::TEMPLATE_SHORT_CIRCUITED)]
final class EachKey extends FilteredArray implements ShortCircuitable
{
    use CanEvaluateShortCircuit;

    public const string TEMPLATE_NESTED = '__nested__';
    public const string TEMPLATE_SHORT_CIRCUITED = '__short_circuited__';

    public function evaluateShortCircuit(mixed $input): Result
    {
        $iterableResult = (new IterableType())->evaluate($input);
        if (!$iterableResult->hasPassed) {
            return $iterableResult->withIdFrom($this);
        }

        $result = null;
        // phpcs:ignore SlevomatCodingStandard.Variables.UnusedVariable.UnusedVariable -- only keys are validated
        foreach ($input as $key => $value) {
            $result = $this->evaluateShortCircuitWith($this->validator, $key);
            if (!$result->hasPassed) {
                return $result->asAdjacentOf(
                    Result::failed($key, $this, [], self::TEMPLATE_NESTED),
                    'eachKey',
                )->withPath(new Path($key));
            }
        }

        if ($result === null) {
            return Result::passed($input, $this)->asIndeterminate();
        }

        return $result->asAdjacentOf(Result::passed($input, $this, [], self::TEMPLATE_SHORT_CIRCUITED), 'eachKey');
    }

    /** @param non-empty-array<mixed> $input */
    protected function evaluateArray(array $input): Result
    {
        $children = [];
        foreach (array_keys($input) as $key) {
            $validatorResult = $this->validator->evaluate($key);
            $children[] = $validatorResult->asAdjacentOf(
                Result::of($validatorResult->hasPassed, $key, $this, [], self::TEMPLATE_NESTED),
                'eachKey',
            )->withPath(new Path($key));
        }

        $hasPassed = array_reduce(
            $children,
            static fn($carry, $childResult) => $carry && $childResult->hasPassed,
            true,
        );

        return Result::of($hasPassed, $input, $this)->withChildren(...$children);
    }
}
