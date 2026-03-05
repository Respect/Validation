<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\CodeGen;

final readonly class InterfaceConfig
{
    /**
     * @param array<string> $rootExtends
     * @param array<string> $rootUses
     */
    public function __construct(
        public string $suffix,
        public string $returnType,
        public bool $static = false,
        public array $rootExtends = [],
        public string|null $rootComment = null,
        public array $rootUses = [],
    ) {
    }
}
