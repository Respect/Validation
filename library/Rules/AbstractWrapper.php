<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;

abstract class AbstractWrapper extends AbstractRule
{
    public function __construct(private Validatable $validatable)
    {
    }

    public function assert(mixed $input): void
    {
        $this->validatable->assert($input);
    }

    public function check(mixed $input): void
    {
        $this->validatable->check($input);
    }

    public function validate(mixed $input): bool
    {
        return $this->validatable->validate($input);
    }

    public function setName(string $name): Validatable
    {
        $this->validatable->setName($name);

        return parent::setName($name);
    }
}
