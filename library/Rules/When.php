<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\AlwaysInvalidException;
use Respect\Validation\Validatable;

final class When extends AbstractRule
{
    private readonly Validatable $else;

    public function __construct(
        private readonly Validatable $when,
        private readonly Validatable $then,
        ?Validatable $else = null
    ) {
        if ($else === null) {
            $else = new AlwaysInvalid();
            $else->setTemplate(AlwaysInvalidException::SIMPLE);
        }

        $this->else = $else;
    }

    public function validate(mixed $input): bool
    {
        if ($this->when->validate($input)) {
            return $this->then->validate($input);
        }

        return $this->else->validate($input);
    }

    public function assert(mixed $input): void
    {
        if ($this->when->validate($input)) {
            $this->then->assert($input);

            return;
        }

        $this->else->assert($input);
    }

    public function check(mixed $input): void
    {
        if ($this->when->validate($input)) {
            $this->then->check($input);

            return;
        }

        $this->else->check($input);
    }
}
