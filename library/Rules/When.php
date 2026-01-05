<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class When implements Validator
{
    public function __construct(
        private Validator $when,
        private Validator $then,
        private Validator $else = new Templated(AlwaysInvalid::TEMPLATE_SIMPLE, new AlwaysInvalid()),
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $whenResult = $this->when->evaluate($input);
        if ($whenResult->hasPassed) {
            return $this->then->evaluate($input);
        }

        return $this->else->evaluate($input);
    }
}
