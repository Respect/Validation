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
        private readonly int|string $value
    ) {
    }

    public function getValue(): int|string
    {
        return $this->value;
    }
}
