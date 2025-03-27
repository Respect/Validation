<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Placeholder;

final class Path
{
    public function __construct(
        public readonly int|string $value,
        public readonly ?Path $child = null
    ) {
    }

    public function withParent(int|string $value): self
    {
        return new self($value, $this);
    }

    public function isEqual(Path $path): bool
    {
        return $this->value === $path->value
            && $this->child?->isEqual($path->child) ?? true;
    }

    public function getDeepest(): Path
    {
        return $this->child?->getDeepest() ?? $this;
    }
}
