<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Factory;
use Respect\Validation\Validatable;

/**
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Vicente Mendoza <vicentemmor@yahoo.com.mx>
 *
 * @deprecated This class is deprecated, and will be removed in the next major version. Use {@see \Respect\Validation\Rules\Core\Simple} instead.
 */
abstract class AbstractRule implements Validatable
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $template;

    /**
     * @deprecated Calling `assert()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::assert()} instead.
     */
    public function assert($input): void
    {
        if ($this->validate($input)) {
            return;
        }

        throw $this->reportError($input);
    }

    /**
     * @deprecated Calling `check()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::check()} instead.
     */
    public function check($input): void
    {
        $this->assert($input);
    }

    /**
     * @deprecated Calling `getName()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::getName()} instead.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param mixed[] $extraParams
     * @deprecated Calling `reportError()` directly is deprecated, and will be removed in the next major version.
     */
    public function reportError($input, array $extraParams = []): ValidationException
    {
        return Factory::getDefaultInstance()->exception($this, $input, $extraParams);
    }

    /**
     * @deprecated Calling `setName()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::setName()} instead.
     */
    public function setName(string $name): Validatable
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @deprecated Calling `setTemplate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::setTemplate()} instead.
     */
    public function setTemplate(string $template): Validatable
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @deprecated Calling validator as a function is deprecated, and will be removed in the next major version.
     * @param mixed $input
     */
    public function __invoke($input): bool
    {
        return $this->validate($input);
    }
}
