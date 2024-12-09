<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Binder;
use Respect\Validation\Rules\Core\Composite;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class Consecutive extends Composite
{
    public function evaluate(mixed $input): Result
    {
        foreach ($this->rules as $rule) {
            $result = (new Binder($this, $rule))->evaluate($input);
            if (!$result->isValid) {
                return $result;
            }
        }

        return $result;
    }
}
