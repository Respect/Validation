<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use ReflectionAttribute;
use ReflectionObject;
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

        $rules = [];
        $reflection = new ReflectionObject($input);
        foreach ($reflection->getAttributes(Rule::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
            $rules[] = $attribute->newInstance();
        }

        foreach ($reflection->getProperties() as $property) {
            $childrenRules = [];
            foreach ($property->getAttributes(Rule::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
                $childrenRules[] = $attribute->newInstance();
            }

            if ($childrenRules === []) {
                continue;
            }

            $allowsNull = $property->getType()?->allowsNull() ?? false;

            $childRule = new Reducer(...$childrenRules);
            $rules[] = new Property($property->getName(), $allowsNull ? new NullOr($childRule) : $childRule);
        }

        if ($rules === []) {
            return (new AlwaysValid())->evaluate($input)->withId($id);
        }

        return (new Reducer(...$rules))->evaluate($input)->withId($id);
    }
}
