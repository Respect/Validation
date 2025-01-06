<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

/**
 * Validates if the input is an instance of the given class or interface.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Instance extends AbstractRule
{
    /**
     * @var string
     */
    private $instanceName;

    /**
     * Initializes the rule with the expected instance name.
     */
    public function __construct(string $instanceName)
    {
        $this->instanceName = $instanceName;
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        return $input instanceof $this->instanceName;
    }
}
