<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Rules;

use Respect\Validation\Rules\AbstractRule;

/**
 * Example of a custom rule that does not have an exception.
 *
 * @author Casey McLaughlin <caseyamcl@gmail.com>
 */
final class CustomRule extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        return false;
    }
}
