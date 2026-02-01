<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use Respect\Validation\Result;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Core\ShortCircuitable;

trait CanEvaluateShortCircuit
{
    private function evaluateShortCircuitWith(Validator $validator, mixed $input): Result
    {
        if ($validator instanceof ShortCircuitable) {
            return $validator->evaluateShortCircuit($input);
        }

        return $validator->evaluate($input);
    }
}
