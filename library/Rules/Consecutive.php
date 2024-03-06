<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanBindEvaluateRule;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Composite;

final class Consecutive extends Composite
{
    use CanBindEvaluateRule;

    public function evaluate(mixed $input): Result
    {
        foreach ($this->rules as $rule) {
            $result = $this->bindEvaluate($rule, $this, $input);
            if (!$result->isValid) {
                return $result;
            }
        }

        return $result;
    }
}
