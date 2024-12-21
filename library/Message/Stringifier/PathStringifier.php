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

use function array_reverse;
use function implode;

final readonly class PathStringifier implements Stringifier
{
    public function __construct(
        private Quoter $quoter,
    ) {
    }

    public function stringify(mixed $raw, int $depth): string|null
    {
        if (!$raw instanceof Path) {
            return null;
        }

        return $this->quoter->quote('.' . implode('.', array_reverse($this->getNodes($raw, []))), $depth);
    }

    /**
     * @param array<string|int> $nodes
     *
     * @return non-empty-array<string|int>
     */
    public function getNodes(Path $path, array $nodes): array
    {
        $nodes[] = $path->value;
        if ($path->parent !== null) {
            return $this->getNodes($path->parent, $nodes);
        }

        return $nodes;
    }
}
