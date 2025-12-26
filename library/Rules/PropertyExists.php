<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use ReflectionClass;
use ReflectionObject;
use Respect\Validation\Message\Template;
use Respect\Validation\Path;
use Respect\Validation\Result;
use Respect\Validation\Rule;

use function is_object;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be present',
    '{{subject}} must not be present',
)]
final readonly class PropertyExists implements Rule
{
    public function __construct(
        private string $propertyName,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        return Result::of(is_object($input) && $this->hasProperty($input), $input, $this)
            ->withPath(new Path($this->propertyName));
    }

    private function hasProperty(object $object): bool
    {
        $reflection = new ReflectionObject($object);
        while ($reflection instanceof ReflectionClass) {
            if ($reflection->hasProperty($this->propertyName)) {
                return true;
            }

            $reflection = $reflection->getParentClass();
        }

        return false;
    }
}
