<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;

/**
 * Abstract class that creates an envelope around another rule.
 *
 * This class is usefull when you want to create rules that use other rules, but
 * having an custom message.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @deprecated This class is deprecated, and will be removed in the next major version. Use {@see \Respect\Validation\Rules\Core\Envelop} instead.
 */
abstract class AbstractEnvelope extends AbstractRule
{
    /**
     * @var Validatable
     */
    private $validatable;

    /**
     * @var mixed[]
     */
    private $parameters;

    /**
     * Initializes the rule.
     *
     * @param mixed[] $parameters
     */
    public function __construct(Validatable $validatable, array $parameters = [])
    {
        $this->validatable = $validatable;
        $this->parameters = $parameters;
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        return $this->validatable->validate($input);
    }

    /**
     * {@inheritDoc}
     */
    public function reportError($input, array $extraParameters = []): ValidationException
    {
        return parent::reportError($input, $extraParameters + $this->parameters);
    }
}
