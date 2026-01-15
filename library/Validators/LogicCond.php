<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class LogicCond implements Validator
{
    public function __construct(
        private Validator $if,
        private Validator $then,
        private Validator $else = new Templated(AlwaysInvalid::TEMPLATE_SIMPLE, new AlwaysInvalid()),
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $ifResult = $this->if->evaluate($input);
        if ($ifResult->hasPassed) {
            return $this->then->evaluate($input);
        }

        return $this->else->evaluate($input);
    }
}
