<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use Attribute;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final readonly class Template
{
    public function __construct(
        public string $default,
        public string $inverted,
        public string $id = Validator::TEMPLATE_STANDARD,
    ) {
    }
}
