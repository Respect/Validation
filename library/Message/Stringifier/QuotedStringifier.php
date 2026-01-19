<?php

declare(strict_types=1);

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

namespace Respect\Validation\Message\Stringifier;

use Respect\Stringifier\Quoter;
use Respect\Stringifier\Stringifier;
use Respect\Validation\Message\Placeholder\Quoted;

final readonly class QuotedStringifier implements Stringifier
{
    public function __construct(
        private Quoter $quoter,
    ) {
    }

    public function stringify(mixed $raw, int $depth): string|null
    {
        if (!$raw instanceof Quoted) {
            return null;
        }

        return $this->quoter->quote($raw->value, $depth);
    }
}
