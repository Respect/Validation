<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionObject;
use ReflectionProperty;
use Respect\Validation\Id;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Reducer;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class Attributes implements Validator
{
    public function evaluate(mixed $input): Result
    {
        $id = new Id('attributes');
        $objectType = (new ObjectType())->evaluate($input);
        if (!$objectType->hasPassed) {
            return $objectType->withId($id);
        }

        $reflection = new ReflectionObject($input);
        $validators = [...$this->getClassRules($reflection), ...$this->getPropertyRules($reflection)];
        if ($validators === []) {
            return (new AlwaysValid())->evaluate($input)->withId($id);
        }

        return (new Reducer(...$validators))->evaluate($input)->withId($id);
    }

    /** @return array<Validator> */
    private function getClassRules(ReflectionObject $reflection): array
    {
        $validators = [];
        while ($reflection instanceof ReflectionClass) {
            foreach ($reflection->getAttributes(Validator::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
                $validators[] = $attribute->newInstance();
            }

            $reflection = $reflection->getParentClass();
        }

        return $validators;
    }

    /** @return array<Validator> */
    private function getPropertyRules(ReflectionObject $reflection): array
    {
        $validators = [];
        foreach ($this->getProperties($reflection) as $propertyName => $property) {
            $propertyRules = [];
            foreach ($property->getAttributes(Validator::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
                $propertyRules[] = $attribute->newInstance();
            }

            if ($propertyRules === []) {
                continue;
            }

            $allowsNull = $property->getType()?->allowsNull() ?? false;

            $childRule = new Reducer(...$propertyRules);
            $validators[] = new Property($propertyName, $allowsNull ? new NullOr($childRule) : $childRule);
        }

        return $validators;
    }

    /** @return array<ReflectionProperty> */
    private function getProperties(ReflectionObject $reflection): array
    {
        $properties = [];
        while ($reflection instanceof ReflectionClass) {
            foreach ($reflection->getProperties() as $property) {
                $properties[$property->name] = $property;
            }

            $reflection = $reflection->getParentClass();
        }

        return $properties;
    }
}
