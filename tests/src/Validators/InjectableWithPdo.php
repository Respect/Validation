<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Validators;

use Attribute;
use PDO;
use Respect\Validation\Validators\Core\Simple;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class InjectableWithPdo extends Simple
{
    public function __construct(
        public readonly string $name = 'default',
        public readonly PDO|null $pdo = null,
    ) {
    }

    public function isValid(mixed $input): bool
    {
        return $this->pdo !== null;
    }
}
