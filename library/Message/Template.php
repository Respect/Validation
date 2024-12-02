<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use Attribute;
use Respect\Validation\Validatable;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class Template
{
    public function __construct(
        public readonly string $default,
        public readonly string $inverted,
        public readonly string $id = Validatable::TEMPLATE_STANDARD,
    ) {
    }
}
