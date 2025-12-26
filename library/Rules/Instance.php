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
use Respect\Validation\Rule;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be an instance of {{class|quote}}',
    '{{subject}} must not be an instance of {{class|quote}}',
)]
final readonly class Instance implements Rule
{
    /** @param class-string $class */
    public function __construct(
        private string $class,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        return Result::of($input instanceof $this->class, $input, $this, ['class' => $this->class]);
    }
}
