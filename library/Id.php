<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use function lcfirst;
use function strrchr;
use function substr;
use function ucfirst;

final readonly class Id
{
    public function __construct(
        public string $value,
    ) {
    }

    public static function fromValidator(Validator $validator): self
    {
        return new self(lcfirst(substr((string) strrchr($validator::class, '\\'), 1)));
    }

    public function withPrefix(string $prefix): self
    {
        return new self($prefix . ucfirst($this->value));
    }
}
