<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Rule;
use Respect\Validation\Rules\AllOf;

final class Reducer extends Wrapper
{
    public function __construct(Rule $rule1, Rule ...$rules)
    {
        parent::__construct($rules === [] ? $rule1 : new AllOf($rule1, ...$rules));
    }
}
