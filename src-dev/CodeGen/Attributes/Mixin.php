<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\CodeGen\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final readonly class Mixin
{
    /**
     * @param array<string> $exclude
     * @param array<string> $include
     */
    public function __construct(
        public string|null $prefix = null,
        public bool $prefixParameter = false,
        public bool $requireInclusion = false,
        public array $exclude = [],
        public array $include = [],
    ) {
    }
}
