<?php

declare(strict_types=1);

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

namespace Respect\Validation\Message\Stringifier;

use Respect\Stringifier\Stringifier;
use Respect\Validation\Name;

use function sprintf;

final readonly class NameStringifier implements Stringifier
{
    public function __construct(
        private Stringifier $stringifier,
    ) {
    }

    public function stringify(mixed $raw, int $depth): string|null
    {
        if (!$raw instanceof Name) {
            return null;
        }

        if ($raw->path === null || $raw->path->isOrphan()) {
            return $raw->value;
        }

        return sprintf(
            '%s (<- %s)',
            $this->stringifier->stringify($raw->path, $depth),
            $raw->value,
        );
    }
}
