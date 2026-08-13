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
use ReflectionReference;
use ReflectionType;
use ReflectionUnionType;
use Respect\Fluent\Attributes\Composable;
use Respect\Parameter\Resolver;
use Respect\Validation\Id;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Core\Reducer;

use function is_array;
use function spl_object_id;

#[Composable(without: [All::class, Key::class, Property::class, Not::class, UndefOr::class])]
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must not contain a circular reference',
    '{{subject}} must contain a circular reference',
    Attributes::TEMPLATE_CIRCULAR_REFERENCE,
)]
final readonly class Attributes implements Validator
{
    public const string TEMPLATE_CIRCULAR_REFERENCE = '__circular_reference__';

    /** @var array<int, true> */
    private array $path;

    public function __construct(private Resolver|null $resolver = null)
    {
        $this->path = self::rootPath();
    }

    public function evaluate(mixed $input): Result
    {
        $id = new Id('attributes');
        $objectType = (new ObjectType())->evaluate($input);
        if (!$objectType->hasPassed) {
            return $objectType->withId($id);
        }

        $objectId = spl_object_id($input);
        if (isset($this->path[$objectId])) {
            return Result::failed($input, $this, [], self::TEMPLATE_CIRCULAR_REFERENCE)->withId($id);
        }

        $path = $this->path + [$objectId => true];
        $child = clone ($this, ['path' => $path]);

        $reflection = new ReflectionObject($input);
        $validators = [...$child->getClassValidators($reflection), ...$child->getPropertyValidators($reflection)];
        $rule = $validators === [] ? new AlwaysValid() : new Reducer(...$validators);

        return $rule->evaluate($input)->withId($id);
    }

    /** @return array<int, true> */
    private static function rootPath(): array
    {
        return [];
    }

    /** @return array<Validator> */
    private function getClassValidators(ReflectionObject $reflection): array
    {
        $validators = [];
        while ($reflection instanceof ReflectionClass) {
            foreach ($reflection->getAttributes(Validator::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
                $validators[] = $this->instantiateAttribute($attribute);
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
        foreach ($property->getAttributes(Validator::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
            if ($attribute->getName() === self::class) {
                $propertyValidators[] = $this;

                continue;
            }

            $propertyValidators[] = $this->instantiateAttribute($attribute);
        }

        $recursion = $this->getRecursionValidator($property->getType());
        if ($recursion === null) {
            return $propertyValidators;
        }

        foreach ($propertyValidators as $propertyValidator) {
            if (self::containsSelf($propertyValidator)) {
                return $propertyValidators;
            }
        }

        $propertyValidators[] = $recursion;

        return $propertyValidators;
    }

    private function getRecursionValidator(ReflectionType|null $type): Validator|null
    {
        if ($type instanceof ReflectionNamedType) {
            return $type->isBuiltin() ? null : $this;
        }

        if ($type instanceof ReflectionIntersectionType) {
            return $this;
        }

        if (!$type instanceof ReflectionUnionType) {
            return null;
        }

        foreach ($type->getTypes() as $innerType) {
            if ($this->getRecursionValidator($innerType) !== null) {
                return new Given(new ObjectType(), $this);
            }
        }

        return null;
    }

    /** @param array<string, true> $visited */
    private static function containsSelf(mixed $value, array &$visited = []): bool
    {
        if ($value instanceof self) {
            return true;
        }

        if (is_array($value)) {
            foreach ($value as $key => $item) {
                if (is_array($item) && !self::isUnvisitedReference($value, $key, $visited)) {
                    continue;
                }

                if (self::containsSelf($item, $visited)) {
                    return true;
                }
            }

            return false;
        }

        if (!$value instanceof Validator) {
            return false;
        }

        $objectId = 'validator:' . spl_object_id($value);
        if (isset($visited[$objectId])) {
            return false;
        }

        $visited[$objectId] = true;
        $reflection = new ReflectionObject($value);
        while ($reflection instanceof ReflectionClass) {
            foreach ($reflection->getProperties() as $property) {
                if ($property->isInitialized($value) && self::containsSelf($property->getValue($value), $visited)) {
                    return true;
                }
            }

            $reflection = $reflection->getParentClass();
        }

        return false;
    }

    /**
     * @param array<mixed> $array
     * @param array<string, true> $visited
     */
    private static function isUnvisitedReference(array $array, int|string $key, array &$visited): bool
    {
        $reference = ReflectionReference::fromArrayElement($array, $key);
        if ($reference === null) {
            return true;
        }

        $referenceId = 'reference:' . $reference->getId();
        if (isset($visited[$referenceId])) {
            return false;
        }

        $visited[$referenceId] = true;

        return true;
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

    /** @param ReflectionAttribute<Validator> $attribute */
    private function instantiateAttribute(ReflectionAttribute $attribute): Validator
    {
        if ($this->resolver === null) {
            return $attribute->newInstance();
        }

        $reflection = new ReflectionClass($attribute->getName());
        $constructor = $reflection->getConstructor();
        if ($constructor === null) {
            return $attribute->newInstance();
        }

        return $reflection->newInstanceArgs($this->resolver->resolve($constructor, $attribute->getArguments()));
    }
}
