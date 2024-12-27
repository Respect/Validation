<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use ReflectionObject;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

use function is_object;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{name}} must be present',
    '{{name}} must not be present',
)]
final class PropertyExists extends Standard
{
    public function __construct(
        private readonly string $propertyName
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        return new Result(
            $this->hasProperty($input),
            $input,
            $this,
            path: $this->propertyName,
        );
    }

    private function hasProperty(mixed $input): bool
    {
        if (!is_object($input)) {
            return false;
        }

        return (new ReflectionObject($input))->hasProperty($this->propertyName);
    }
}
