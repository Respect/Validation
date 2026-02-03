<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Name;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Core\Nameable;

use function is_string;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class Named implements Nameable
{
    private Name $name;

    public function __construct(
        string|Name $name,
        private Validator $validator,
    ) {
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
