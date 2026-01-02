<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Name;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Nameable;
use Respect\Validation\Rules\Core\Wrapper;

use function is_string;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class Named extends Wrapper implements Nameable
{
    private readonly Name $name;

    public function __construct(string|Name $name, Rule $rule)
    {
        parent::__construct($rule);

        $this->name = is_string($name) ? new Name($name) : $name;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function evaluate(mixed $input): Result
    {
        return $this->rule->evaluate($input)->withName($this->name);
    }
}
