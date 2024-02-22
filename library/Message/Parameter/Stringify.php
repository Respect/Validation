<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Parameter;

use function is_string;
use function Respect\Stringifier\stringify;

final class Stringify implements Processor
{
    public function process(string $name, mixed $value, ?string $modifier = null): string
    {
        if ($name === 'name' && is_string($value)) {
            return $value;
        }

        return stringify($value);
    }
}
