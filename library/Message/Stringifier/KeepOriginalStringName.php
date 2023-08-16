<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Stringifier;

use Respect\Validation\Message\ParameterStringifier;

use function is_string;
use function Respect\Stringifier\stringify;

final class KeepOriginalStringName implements ParameterStringifier
{
    /**
     * {@inheritDoc}
     */
    public function stringify(string $name, $value): string
    {
        if ($name === 'name' && is_string($value)) {
            return $value;
        }

        return stringify($value);
    }
}
