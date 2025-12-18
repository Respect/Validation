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
final class When implements Rule
{
    private readonly Rule $else;

    public function __construct(
        private readonly Rule $when,
        private readonly Rule $then,
        ?Rule $else = null
    ) {
        if ($else === null) {
            $else = new Templated(new AlwaysInvalid(), AlwaysInvalid::TEMPLATE_SIMPLE);
        }

        $this->else = $else;
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
