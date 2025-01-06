<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\AlwaysInvalidException;
use Respect\Validation\Validatable;

/**
 * A ternary validator that accepts three parameters.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Hugo Hamon <hugo.hamon@sensiolabs.com>
 */
final class When extends AbstractRule
{
    /**
     * @var Validatable
     */
    private $when;

    /**
     * @var Validatable
     */
    private $then;

    /**
     * @var Validatable
     */
    private $else;

    public function __construct(Validatable $when, Validatable $then, ?Validatable $else = null)
    {
        $this->when = $when;
        $this->then = $then;
        if ($else === null) {
            $else = new AlwaysInvalid();
            $else->setTemplate(AlwaysInvalidException::SIMPLE);
        }

        $this->else = $else;
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if ($this->when->validate($input)) {
            return $this->then->validate($input);
        }

        return $this->else->validate($input);
    }

    /**
     * @deprecated Calling `assert()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::assert()} instead.
     */
    public function assert($input): void
    {
        if ($this->when->validate($input)) {
            $this->then->assert($input);

            return;
        }

        $this->else->assert($input);
    }

    /**
     * @deprecated Calling `check()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::check()} instead.
     */
    public function check($input): void
    {
        if ($this->when->validate($input)) {
            $this->then->check($input);

            return;
        }

        $this->else->check($input);
    }
}
