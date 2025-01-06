<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;

/**
 * Abstract class to help on creating rules that wrap rules.
 *
 * @author Alasdair North <alasdair@runway.io>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @deprecated This class is deprecated, and will be removed in the next major version. Use {@see \Respect\Validation\Rules\Core\Wrapper} instead.
 */
abstract class AbstractWrapper extends AbstractRule
{
    /**
     * @var Validatable
     */
    private $validatable;

    /**
     * Initializes the rule.
     */
    public function __construct(Validatable $validatable)
    {
        $this->validatable = $validatable;
    }

    /**
     * @deprecated Calling `assert()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::assert()} instead.
     */
    public function assert($input): void
    {
        $this->validatable->assert($input);
    }

    /**
     * @deprecated Calling `check()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::check()} instead.
     */
    public function check($input): void
    {
        $this->validatable->check($input);
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        return $this->validatable->validate($input);
    }

    /**
     * @deprecated Calling `setName()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::setName()} instead.
     */
    public function setName(string $name): Validatable
    {
        $this->validatable->setName($name);

        return parent::setName($name);
    }
}
