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
use Respect\Validation\Rules\Core\Nameable;
use Respect\Validation\Rules\Core\Wrapper;
use Respect\Validation\Validator;

use function is_string;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class Named extends Wrapper implements Nameable
{
    private readonly Name $name;

    public function __construct(string|Name $name, Validator $validator)
    {
        parent::__construct($validator);

        $this->name = is_string($name) ? new Name($name) : $name;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function evaluate(mixed $input): Result
    {
        return $this->validator->evaluate($input)->withName($this->name);
    }
}
