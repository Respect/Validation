<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

final class Path
{
    public function __construct(
        public int|string $value,
        public Path|null $parent = null,
    ) {
    }

    public function isOrphan(): bool
    {
        return $this->parent === null;
    }

    public function withParent(self $parent): self
    {
        if ($parent === $this->parent) {
            return $this;
        }

        $this->parent = $parent;

        return $this;
    }
}
