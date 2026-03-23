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
use ReflectionIntersectionType;
use ReflectionNamedType;
use ReflectionObject;
use ReflectionProperty;
use ReflectionUnionType;
use Respect\Fluent\Attributes\Composable;
use Respect\Validation\Id;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Core\Reducer;

use function spl_object_id;

#[Composable(without: [All::class, Key::class, Property::class, Not::class, UndefOr::class])]
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must not contain a circular reference',
    '{{subject}} must contain a circular reference',
    Attributes::TEMPLATE_CIRCULAR_REFERENCE,
)]
final class Attributes implements Validator
{
    public const string TEMPLATE_CIRCULAR_REFERENCE = '__circular_reference__';

    /** @var array<int, true> */
    private array $visited = [];

    public function evaluate(mixed $input): Result
    {
        $id = new Id('attributes');
        $objectType = (new ObjectType())->evaluate($input);
        if (!$objectType->hasPassed) {
            return $objectType->withId($id);
        }

        $objectId = spl_object_id($input);
        if (isset($this->visited[$objectId])) {
            return Result::failed($input, $this, [], self::TEMPLATE_CIRCULAR_REFERENCE)->withId($id);
        }

        $this->visited[$objectId] = true;

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
            $propertyValidators = $this->getPropertyInnerValidators($property);
            if ($propertyValidators === []) {
                continue;
            }

            $allowsNull = $property->getType()?->allowsNull() ?? false;

            $childRule = new Reducer(...$propertyValidators);
            $validators[] = new Property($propertyName, $allowsNull ? new NullOr($childRule) : $childRule);
        }

        return $validators;
    }

    /** @return array<Validator> */
    private function getPropertyInnerValidators(ReflectionProperty $property): array
    {
        $propertyValidators = [];
        $hasExplicitAttributes = false;
        foreach ($property->getAttributes(Validator::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
            $propertyValidator = $attribute->getName() === self::class ? $this : $attribute->newInstance();
            $hasExplicitAttributes = $propertyValidator === $this;
            $propertyValidators[] = $propertyValidator;
        }

        if ($hasExplicitAttributes) {
            return $propertyValidators;
        }

        $type = $property->getType();
        if ($type instanceof ReflectionNamedType) {
            if (!$type->isBuiltin()) {
                $propertyValidators[] = $this;
            }
        }

        if ($type instanceof ReflectionIntersectionType) {
            $propertyValidators[] = $this;
        }

        if ($type instanceof ReflectionUnionType) {
            foreach ($type->getTypes() as $innerType) {
                if (!$innerType instanceof ReflectionNamedType || $innerType->isBuiltin()) {
                    continue;
                }

                /** @var class-string $class */
                $class = $innerType->getName();
                $propertyValidators[] = new Given(new Instance($class), $this);
            }
        }

        return $propertyValidators;
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
