<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Rules\AllOf;
use Respect\Validation\Validator;

final class Reducer extends Wrapper
{
    public function __construct(Validator $validator1, Validator ...$validators)
    {
        parent::__construct($validators === [] ? $validator1 : new AllOf($validator1, ...$validators));
    }
}
