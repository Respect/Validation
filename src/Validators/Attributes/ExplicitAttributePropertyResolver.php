<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Attributes;

use ReflectionAttribute;
use ReflectionClass;
use ReflectionProperty;
use Respect\Parameter\Resolver;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Attributes;

final class ExplicitAttributePropertyResolver implements PropertyResolver
{
    public function __construct(
        private readonly Resolver $resolver,
    ) {
    }

    /** @return array<Validator> */
    public function resolve(ReflectionProperty $property, Attributes $attributes): array
    {
        $validators = [];
        foreach ($property->getAttributes(Validator::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
            $propertyValidator = $this->toValidator($attribute, $attributes);
            $validators[] = $propertyValidator;
        }

        return $validators;
    }

    private function toValidator(ReflectionAttribute $attribute, Attributes $attributes): Validator
    {
        /** @var class-string<Validator> $name */
        $name = $attribute->getName();
        if ($name === Attributes::class) {
            return $attributes;
        }

        $reflection = new ReflectionClass($name);
        $constructor = $reflection->getConstructor();
        if ($constructor === null) {
            return $attribute->newInstance();
        }

        return $reflection->newInstanceArgs($this->resolver->resolve($constructor, $attribute->getArguments()));
    }
}
