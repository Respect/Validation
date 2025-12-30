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
use Respect\Validation\Path;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Wrapper;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class Property extends Wrapper
{
    public function __construct(
        private readonly string $propertyName,
        Rule $rule,
    ) {
        parent::__construct($rule);
    }

    public function evaluate(mixed $input): Result
    {
        $propertyExistsResult = (new PropertyExists($this->propertyName))->evaluate($input);
        if (!$propertyExistsResult->hasPassed) {
            return $propertyExistsResult->withNameFrom($this->rule);
        }

        return $this->rule
            ->evaluate($this->getPropertyValue($input, $this->propertyName))
            ->withPath($propertyExistsResult->path ?? new Path($this->propertyName));
    }

    private function getPropertyValue(object $object, string $propertyName): mixed
    {
        $reflection = new ReflectionObject($object);
        while ($reflection instanceof ReflectionClass) {
            if ($reflection->hasProperty($propertyName)) {
                $property = $reflection->getProperty($propertyName);

                return $property->isInitialized($object) ? $property->getValue($object) : null;
            }

            $reflection = $reflection->getParentClass();
        }

        return null;
    }
}
