<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

use const FILTER_VALIDATE_URL;

/**
 * Validates whether the input is a URL.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Url extends AbstractEnvelope
{
    /**
     * Initializes the rule.
     *
     * @throws ComponentException
     */
    public function __construct()
    {
        parent::__construct(new FilterVar(FILTER_VALIDATE_URL));
    }
}
