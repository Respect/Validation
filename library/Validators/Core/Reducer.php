<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use Respect\Validation\Validator;
use Respect\Validation\Validators\LogicAnd;

final class Reducer extends Wrapper
{
    public function __construct(Validator $validator1, Validator ...$validators)
    {
        parent::__construct($validators === [] ? $validator1 : new LogicAnd($validator1, ...$validators));
    }
}
