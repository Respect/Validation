<?php

declare(strict_types=1);

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

namespace Respect\Validation\Message\Stringifier;

use Respect\Stringifier\Stringifier;
use Respect\Validation\Message\Placeholder\Listed;

use function array_map;
use function array_pop;
use function count;
use function implode;
use function sprintf;

final class ListedStringifier implements Stringifier
{
    public function __construct(
        private readonly Stringifier $stringifier
    ) {
    }

    public function stringify(mixed $raw, int $depth): ?string
    {
        if (!$raw instanceof Listed) {
            return null;
        }

        if (count($raw->values) === 0) {
            return null;
        }

        $strings = array_map(fn ($value) => $this->stringifier->stringify($value, $depth + 1), $raw->values);
        if (count($strings) < 3) {
            return implode(sprintf(' %s ', $raw->lastGlue), $strings);
        }
        $lastString = array_pop($strings);

        return sprintf('%s, %s %s', implode(', ', $strings), $raw->lastGlue, $lastString);
    }
}
