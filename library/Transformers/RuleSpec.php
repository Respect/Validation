<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

final readonly class RuleSpec
{
    /** @param array<mixed> $arguments */
    public function __construct(
        public string $name,
        public array $arguments = [],
        public RuleSpec|null $wrapper = null,
    ) {
    }
}
