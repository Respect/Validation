<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Nameable;
use Respect\Validation\Rules\Core\Wrapper;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class Named extends Wrapper implements Nameable
{
    public function __construct(
        Rule $rule,
        private readonly string $name,
    ) {
        parent::__construct($rule);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function evaluate(mixed $input): Result
    {
        return $this->rule->evaluate($input)->withName($this->name);
    }
}
