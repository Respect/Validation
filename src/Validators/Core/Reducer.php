<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use Respect\Validation\Validator;
use Respect\Validation\Validators\AllOf;

final class Reducer extends Wrapper
{
    public function __construct(Validator $validator1, Validator ...$validators)
    {
        parent::__construct($validators === [] ? $validator1 : new AllOf($validator1, ...$validators));
    }
}
