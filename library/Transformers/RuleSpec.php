<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

final class RuleSpec
{
    /** @param array<mixed> $arguments */
    public function __construct(
        public readonly string $name,
        public readonly array $arguments = [],
        public readonly ?RuleSpec $wrapper = null,
    ) {
    }
}
