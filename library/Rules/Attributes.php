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
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Binder;
use Respect\Validation\Rules\Core\Reducer;
use Respect\Validation\Rules\Core\Standard;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class Attributes extends Standard
{
    public function evaluate(mixed $input): Result
    {
        $objectType = (new Binder($this, new ObjectType()))->evaluate($input);
        if (!$objectType->isValid) {
            return $objectType->withId('attributes');
        }

        $rules = [];
        foreach ((new ReflectionObject($input))->getProperties() as $property) {
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
            return (new AlwaysValid())->evaluate($input)->withId('attributes');
        }

        return (new Binder($this, new Reducer(...$rules)))->evaluate($input)->withId('attributes');
    }
}
