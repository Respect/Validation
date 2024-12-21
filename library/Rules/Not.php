<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Wrapper;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class Not extends Wrapper
{
    public function evaluate(mixed $input): Result
    {
        $result = $this->rule->evaluate($input);

        return $result
            ->withToggledModeAndValidation()
            ->withId($result->id->withPrefix('not'));
    }
}
