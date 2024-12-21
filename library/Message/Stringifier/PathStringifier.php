<?php

declare(strict_types=1);

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

namespace Respect\Validation\Message\Stringifier;

use Respect\Stringifier\Quoter;
use Respect\Stringifier\Stringifier;
use Respect\Validation\Message\Placeholder\Path;

final class PathStringifier implements Stringifier
{
    public function __construct(
        private readonly Quoter $quoter
    ) {
    }

    public function stringify(mixed $raw, int $depth): ?string
    {
        if (!$raw instanceof Path) {
            return null;
        }

        return $this->quoter->quote('.' . $raw->getValue(), $depth);
    }
}
