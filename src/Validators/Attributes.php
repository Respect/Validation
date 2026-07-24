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
use Respect\Fluent\Attributes\Composable;
use Respect\Validation\Id;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Attributes\BypassResolver;
use Respect\Validation\Validators\Attributes\CompositePropertyResolver;
use Respect\Validation\Validators\Attributes\DeclaredTypePropertyResolver;
use Respect\Validation\Validators\Attributes\ExplicitAttributePropertyResolver;
use Respect\Validation\Validators\Attributes\PropertyResolver;
use Respect\Validation\Validators\Core\Reducer;
use WeakMap;

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

    /** @var WeakMap<object, true> */
    private WeakMap $visited;

    private readonly PropertyResolver $propertyResolver;

    public function __construct(
        PropertyResolver|null $propertyResolver = null,
    ) {
        $this->propertyResolver = $propertyResolver ?? new CompositePropertyResolver(
            new ExplicitAttributePropertyResolver(new BypassResolver()),
            new DeclaredTypePropertyResolver(),
        );
        $this->visited = new WeakMap();
    }

    public function evaluate(mixed $input): Result
    {
        $id = new Id('attributes');
        $objectType = (new ObjectType())->evaluate($input);
        if (!$objectType->hasPassed) {
            return $objectType->withId($id);
        }

        if ($this->visited->offsetExists($input)) {
            return Result::failed($input, $this, [], self::TEMPLATE_CIRCULAR_REFERENCE)->withId($id);
        }

        $this->visited[$input] = true;

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
            $propertyValidators = $this->propertyResolver->resolve($property, $this);
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

    /** @return list<string> */
    public function __sleep(): array
    {
        return ['propertyResolver'];
    }

    public function __wakeup(): void
    {
        $this->visited = new WeakMap();
    }
}
