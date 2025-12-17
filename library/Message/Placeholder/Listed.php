<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Placeholder;

final readonly class Listed
{
    /** @param array<int, mixed> $values */
    public function __construct(
        public array $values,
        public string $lastGlue
    ) {
    }
}
