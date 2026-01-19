<?php

declare(strict_types=1);

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
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
