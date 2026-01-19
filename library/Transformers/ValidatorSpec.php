<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

final readonly class ValidatorSpec
{
    /** @param array<mixed> $arguments */
    public function __construct(
        public string $name,
        public array $arguments = [],
        public ValidatorSpec|null $wrapper = null,
    ) {
    }
}
