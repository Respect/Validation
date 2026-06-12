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
use Respect\Dev\CodeGen\FluentBuilder\Mixin;
use Respect\Validation\ArgumentsResolver;
use Respect\Validation\Id;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Core\Reducer;

#[Mixin(exclude: ['all', 'key', 'property', 'not', 'undefOr'])]
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class Attributes implements Validator
{
    public function __construct(
        private readonly ArgumentsResolver|null $argumentsResolver = null,
    ) {
    }

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
                $validators[] = $this->createValidator($attribute);
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
                $propertyValidators[] = $this->createValidator($attribute);
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

    /** @param ReflectionAttribute<Validator> $attribute */
    private function createValidator(ReflectionAttribute $attribute): Validator
    {
        if ($this->argumentsResolver === null) {
            return $attribute->newInstance();
        }

        $reflection = new ReflectionClass($attribute->getName());
        $constructor = $reflection->getConstructor();
        if ($constructor === null) {
            return $attribute->newInstance();
        }

        return $reflection->newInstanceArgs(
            $this->argumentsResolver->resolve($constructor, $attribute->getArguments()),
        );
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
