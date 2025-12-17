<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Placeholder;

final readonly class Quoted
{
    public function __construct(
        private string $value,
    ) {
    }

    public static function fromPath(int|string $path): self
    {
        return new self('.' . $path);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
