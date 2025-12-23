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
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Reducer;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class Attributes implements Rule
{
    public function evaluate(mixed $input): Result
    {
        $id = new Id('attributes');
        $objectType = (new ObjectType())->evaluate($input);
        if (!$objectType->hasPassed) {
            return $objectType->withId($id);
        }

        $reflection = new ReflectionObject($input);
        $rules = [...$this->getClassRules($reflection), ...$this->getPropertyRules($reflection)];
        if ($rules === []) {
            return (new AlwaysValid())->evaluate($input)->withId($id);
        }

        return (new Reducer(...$rules))->evaluate($input)->withId($id);
    }

    /** @return array<Rule> */
    private function getClassRules(ReflectionObject $reflection): array
    {
        $rules = [];
        while ($reflection instanceof ReflectionClass) {
            foreach ($reflection->getAttributes(Rule::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
                $rules[] = $attribute->newInstance();
            }

            $reflection = $reflection->getParentClass();
        }

        return $rules;
    }

    /** @return array<Rule> */
    private function getPropertyRules(ReflectionObject $reflection): array
    {
        $rules = [];
        foreach ($this->getProperties($reflection) as $propertyName => $property) {
            $propertyRules = [];
            foreach ($property->getAttributes(Rule::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
                $propertyRules[] = $attribute->newInstance();
            }

            if ($propertyRules === []) {
                continue;
            }

            $allowsNull = $property->getType()?->allowsNull() ?? false;

            $childRule = new Reducer(...$propertyRules);
            $rules[] = new Property($propertyName, $allowsNull ? new NullOr($childRule) : $childRule);
        }

        return $rules;
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
