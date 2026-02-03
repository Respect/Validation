<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Parameters;

use Respect\Stringifier\Handler;
use Respect\Stringifier\Quoter;
use Respect\Validation\Path;

use function array_reverse;
use function implode;

final readonly class PathHandler implements Handler
{
    public function __construct(
        private Quoter $quoter,
    ) {
    }

    public function handle(mixed $raw, int $depth): string|null
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
