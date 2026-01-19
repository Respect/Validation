<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

final class Path
{
    public function __construct(
        public readonly int|string $value,
        public Path|null $parent = null,
    ) {
    }
}
