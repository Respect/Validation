<?php

declare(strict_types=1);

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

namespace Respect\Validation\Message\Stringifier;

use Respect\Stringifier\Stringifier;
use Respect\Validation\Name;

final readonly class NameStringifier implements Stringifier
{
    public function stringify(mixed $raw, int $depth): string|null
    {
        if (!$raw instanceof Name) {
            return null;
        }

        return $raw->value;
    }
}
