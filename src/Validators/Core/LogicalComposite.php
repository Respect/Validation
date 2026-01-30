<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use Respect\Validation\Validator;
use Respect\Validation\Validators\Composite;

abstract readonly class LogicalComposite extends Composite implements Validator
{
    public function __construct(Validator $validator1, Validator $validator2, Validator ...$validators)
    {
        parent::__construct($validator1, $validator2, ...$validators);
    }
}
