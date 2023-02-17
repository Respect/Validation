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
     * {@inheritDoc}
     */
    public function assert($input): void
    {
        $this->validatable->assert($input);
    }

    /**
     * {@inheritDoc}
     */
    public function check($input): void
    {
        $this->validatable->check($input);
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        return $this->validatable->validate($input);
    }

    /**
     * {@inheritDoc}
     */
    public function setName(string $name): Validatable
    {
        $this->validatable->setName($name);

        return parent::setName($name);
    }
}
