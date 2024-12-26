<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Helpers\DeprecatedValidatableMethods;
use Respect\Validation\Result;
use Respect\Validation\Rule;

abstract class Wrapper implements Rule
{
    use DeprecatedValidatableMethods;

    public function __construct(
        protected readonly Rule $rule
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        return $this->rule->evaluate($input);
    }

    public function getName(): ?string
    {
        return $this->rule->getName();
    }

    public function setName(string $name): static
    {
        $this->rule->setName($name);

        return $this;
    }

    public function getRule(): Rule
    {
        return $this->rule;
    }
}
