<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ReflectionObject;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

use function is_object;

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
        if (!is_object($input)) {
            return Result::failed($input, $this)->withNameIfMissing($this->propertyName);
        }

        $reflection = new ReflectionObject($input);

        return new Result($reflection->hasProperty($this->propertyName), $input, $this, name: $this->propertyName);
    }
}
