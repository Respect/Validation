<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Rule;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class When implements Rule
{
    public function __construct(
        private Rule $when,
        private Rule $then,
        private Rule $else = new Templated(new AlwaysInvalid(), AlwaysInvalid::TEMPLATE_SIMPLE)
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
