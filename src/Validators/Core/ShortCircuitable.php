<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use Respect\Validation\Result;
use Respect\Validation\Validator;

interface ShortCircuitable extends Validator
{
    public function evaluateShortCircuit(mixed $input): Result;
}
