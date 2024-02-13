<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Result;

final class Not extends Wrapper
{
    public function evaluate(mixed $input): Result
    {
        return parent::evaluate($input)->withInvertedMode();
    }
}
