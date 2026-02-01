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
use Respect\Validation\Helpers\CanEvaluateShortCircuit;
use Respect\Validation\Message\Template;
use Respect\Validation\Path;
use Respect\Validation\Result;
use Respect\Validation\Validators\Core\FilteredArray;
use Respect\Validation\Validators\Core\ShortCircuitable;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template('Every item in', 'Every item in')]
final class All extends FilteredArray implements ShortCircuitable
{
    use CanEvaluateShortCircuit;

    public function evaluateShortCircuit(mixed $input): Result
    {
        $iterableResult = (new IterableType())->evaluate($input);
        if (!$iterableResult->hasPassed) {
            return $iterableResult->withIdFrom($this);
        }

        $result = null;
        foreach ($input as $key => $value) {
            $result = $this->evaluateShortCircuitWith($this->validator, $value);
            if (!$result->hasPassed) {
                return $result->withPath(new Path($key));
            }
        }

        if ($result === null) {
            return Result::passed($input, $this)->asIndeterminate();
        }

        return Result::passed($input, $this)->asAdjacentOf($result, 'all');
    }

    /** @param non-empty-array<mixed> $input */
    protected function evaluateArray(array $input): Result
    {
        $result = null;
        $hasPassed = true;
        foreach ($input as $value) {
            $result = $this->validator->evaluate($value);
            if ($result->hasPassed === false) {
                $hasPassed = false;
                break;
            }
        }

        return $result->asAdjacentOf(
            Result::of($hasPassed, $input, $this),
            'all',
        );
    }
}
