<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Helpers\CanEvaluateShortCircuit;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class ShortCircuit implements Validator
{
    use CanEvaluateShortCircuit;

    /** @var non-empty-array<Validator> */
    private array $validators;

    public function __construct(Validator ...$validators)
    {
        $this->validators = $validators === [] ? [new AlwaysValid()] : $validators;
    }

    public function evaluate(mixed $input): Result
    {
        foreach ($this->validators as $validator) {
            $result = $this->evaluateShortCircuitWith($validator, $input);
            if (!$result->hasPassed) {
                return $result;
            }
        }

        return $result;
    }
}
