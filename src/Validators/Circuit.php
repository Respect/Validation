<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class Circuit implements Validator
{
    /** @var non-empty-array<Validator> */
    private readonly array $validators;

    public function __construct(Validator $validator1, Validator $validator2, Validator ...$validators)
    {
        $this->validators = [$validator1, $validator2, ...$validators];
    }

    public function evaluate(mixed $input): Result
    {
        foreach ($this->validators as $validator) {
            $result = $validator->evaluate($input);
            if (!$result->hasPassed) {
                return $result;
            }
        }

        return $result;
    }
}
