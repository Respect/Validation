<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be an instance of `{{class|raw}}`',
    '{{name}} must not be an instance of `{{class|raw}}`',
)]
final class Instance extends Standard
{
    /** @param class-string $class */
    public function __construct(
        private readonly string $class
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        return new Result($input instanceof $this->class, $input, $this, ['class' => $this->class]);
    }
}
