<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionObject;
use ReflectionProperty;
use Respect\Validation\Id;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Core\Reducer;

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
        $validators = [...$this->getClassValidators($reflection), ...$this->getPropertyValidators($reflection)];
        if ($validators === []) {
            return (new AlwaysValid())->evaluate($input)->withId($id);
        }

        return (new Reducer(...$validators))->evaluate($input)->withId($id);
    }

    /** @return array<Validator> */
    private function getClassValidators(ReflectionObject $reflection): array
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
    private function getPropertyValidators(ReflectionObject $reflection): array
    {
        $validators = [];
        foreach ($this->getProperties($reflection) as $propertyName => $property) {
            $propertyValidators = [];
            foreach ($property->getAttributes(Validator::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
                $propertyValidators[] = $attribute->newInstance();
            }

            if ($propertyValidators === []) {
                continue;
            }

            $allowsNull = $property->getType()?->allowsNull() ?? false;

            $childRule = new Reducer(...$propertyValidators);
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
