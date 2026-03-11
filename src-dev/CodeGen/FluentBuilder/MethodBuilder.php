<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\CodeGen\FluentBuilder;

use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpNamespace;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;

use function count;
use function implode;
use function in_array;
use function is_object;
use function lcfirst;
use function preg_replace;
use function sort;
use function str_starts_with;
use function ucfirst;

final class MethodBuilder
{
    /**
     * @param array<string> $excludedTypePrefixes
     * @param array<string> $excludedTypeNames
     */
    public function __construct(
        private readonly array $excludedTypePrefixes = [],
        private readonly array $excludedTypeNames = [],
    ) {
    }

    public function build(
        PhpNamespace $namespace,
        ReflectionClass $nodeReflection,
        string $returnType,
        string|null $prefix = null,
        bool $static = false,
        ReflectionParameter|null $prefixParameter = null,
    ): Method {
        $originalName = $nodeReflection->getShortName();
        $name = $prefix ? $prefix . ucfirst($originalName) : lcfirst($originalName);

        $method = new Method($name);
        $method->setPublic()->setReturnType($returnType);

        if ($static) {
            $method->setStatic();
        }

        if ($prefixParameter !== null) {
            $this->addPrefixParameter($method, $prefixParameter);
        }

        $constructor = $nodeReflection->getConstructor();
        if ($constructor === null) {
            return $method;
        }

        $comment = $constructor->getDocComment();
        if ($comment) {
            $method->addComment(preg_replace('@(/\*\* *| +\* +| +\*/)@', '', $comment));
        }

        foreach ($constructor->getParameters() as $reflectionParameter) {
            $this->addParameter($method, $reflectionParameter, $namespace);
        }

        return $method;
    }

    private function addPrefixParameter(Method $method, ReflectionParameter $reflectionParameter): void
    {
        $type = $reflectionParameter->getType();
        $types = [];

        if ($type instanceof ReflectionUnionType) {
            foreach ($type->getTypes() as $subType) {
                $types[] = $subType->getName();
            }

            sort($types);
        } elseif ($type instanceof ReflectionNamedType) {
            $types[] = $type->getName();
        }

        $method->addParameter($reflectionParameter->getName())->setType(implode('|', $types));
    }

    private function addParameter(
        Method $method,
        ReflectionParameter $reflectionParameter,
        PhpNamespace $namespace,
    ): void {
        if ($reflectionParameter->isVariadic()) {
            $method->setVariadic();
        }

        $type = $reflectionParameter->getType();
        $types = [];

        if ($type instanceof ReflectionUnionType) {
            foreach ($type->getTypes() as $subType) {
                $types[] = $subType->getName();
                if ($subType->isBuiltin()) {
                    continue;
                }

                $namespace->addUse($subType->getName());
            }
        } elseif ($type instanceof ReflectionNamedType) {
            $types[] = $type->getName();

            if ($this->isExcludedType($type->getName())) {
                return;
            }

            if (!$type->isBuiltin()) {
                $namespace->addUse($type->getName());
            }
        }

        $parameter = $method->addParameter($reflectionParameter->getName());
        $parameter->setType(implode('|', $types));

        if (!$reflectionParameter->isDefaultValueAvailable()) {
            $parameter->setNullable($reflectionParameter->isOptional());
        }

        if (count($types) > 1 || $reflectionParameter->isVariadic()) {
            $parameter->setNullable(false);
        }

        if (!$reflectionParameter->isDefaultValueAvailable()) {
            return;
        }

        $defaultValue = $reflectionParameter->getDefaultValue();
        if (is_object($defaultValue)) {
            $parameter->setDefaultValue(null);
            $parameter->setNullable(true);

            return;
        }

        $parameter->setDefaultValue($defaultValue);
        $parameter->setNullable(false);
    }

    private function isExcludedType(string $typeName): bool
    {
        foreach ($this->excludedTypePrefixes as $excludedPrefix) {
            if (str_starts_with($typeName, $excludedPrefix)) {
                return true;
            }
        }

        return in_array($typeName, $this->excludedTypeNames, true);
    }
}
