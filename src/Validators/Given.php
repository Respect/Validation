<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class Given implements Validator
{
    public function __construct(
        private Validator $when,
        private Validator $then,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        if ($this->when->evaluate($input)->hasPassed) {
            return $this->then->evaluate($input);
        }

        return (new AlwaysValid())->evaluate($input);
    }
}
