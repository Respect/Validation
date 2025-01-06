<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Rules\AbstractComposite;
use Respect\Validation\Validatable;

abstract class Composite extends AbstractComposite
{
    public function __construct(Validatable $rule1, Validatable $rule2, Validatable ...$rules)
    {
        parent::__construct($rule1, $rule2, ...$rules);
    }
}
