<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Result;
use Respect\Validation\Validatable;

abstract class AbstractWrapper extends AbstractRule
{
    public function __construct(
        private readonly Validatable $validatable
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        return $this->validatable->evaluate($input);
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

    public function setName(string $name): static
    {
        $this->validatable->setName($name);

        return parent::setName($name);
    }

    public function setTemplate(string $template): static
    {
        $this->validatable->setTemplate($template);

        return parent::setTemplate($template);
    }
}
