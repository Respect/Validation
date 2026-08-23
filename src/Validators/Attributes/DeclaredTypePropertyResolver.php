<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Attributes;

use ReflectionIntersectionType;
use ReflectionNamedType;
use ReflectionProperty;
use ReflectionUnionType;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Attributes;
use Respect\Validation\Validators\Given;
use Respect\Validation\Validators\Instance;

final class DeclaredTypePropertyResolver implements PropertyResolver
{
    /** @return array<Validator> */
    public function resolve(ReflectionProperty $property, Attributes $attributes): array
    {
        $type = $property->getType();

        if ($type instanceof ReflectionNamedType) {
            if ($type->isBuiltin()) {
                return [];
            }

            return [$attributes];
        }

        if ($type instanceof ReflectionIntersectionType) {
            return [$attributes];
        }

        if ($type instanceof ReflectionUnionType) {
            $validators = [];
            foreach ($type->getTypes() as $innerType) {
                if (!$innerType instanceof ReflectionNamedType || $innerType->isBuiltin()) {
                    continue;
                }

                /** @var class-string $class */
                $class = $innerType->getName();
                $validators[] = new Given(new Instance($class), $attributes);
            }

            return $validators;
        }

        return [];
    }
}
