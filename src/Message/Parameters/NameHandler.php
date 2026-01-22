<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Parameters;

use Respect\Stringifier\Handler;
use Respect\Validation\Name;

final readonly class NameHandler implements Handler
{
    public function handle(mixed $raw, int $depth): string|null
    {
        if (!$raw instanceof Name) {
            return null;
        }

        return $raw->value;
    }
}
