<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Placeholder;

final readonly class Name
{
    public function __construct(
        public string $value,
        public Path|null $path = null,
    ) {
    }

    public function withPath(Path $path): Name
    {
        return new self($this->value, $path);
    }
}
