<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Attributes;

use Attribute;
use Respect\Validation\Exceptions\ValidationException;

#[Attribute(Attribute::TARGET_CLASS)]
final class ExceptionClass
{
    /**
     * @param class-string<ValidationException> $class
     */
    public function __construct(
        public readonly string $class
    ) {
    }
}
