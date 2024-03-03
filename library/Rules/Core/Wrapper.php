<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Helpers\DeprecatedValidatableMethods;
use Respect\Validation\Result;
use Respect\Validation\Validatable;

abstract class Wrapper implements Validatable
{
    use DeprecatedValidatableMethods;

    public function __construct(
        protected readonly Validatable $rule
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

    public function getTemplate(): ?string
    {
        return $this->rule->getTemplate();
    }

    public function setTemplate(string $template): static
    {
        $this->rule->setTemplate($template);

        return $this;
    }
}
