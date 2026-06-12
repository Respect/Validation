<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Psr\Container\ContainerInterface;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use ReflectionNamedType;

use function array_filter;
use function array_is_list;
use function array_key_exists;
use function array_keys;
use function class_exists;
use function count;
use function in_array;
use function interface_exists;
use function is_int;

final class ContainerArgumentsResolver implements ArgumentsResolver
{
    /** @var array<string, list<array{int, string, class-string}>> */
    private array $injectableParametersCache = [];

    /** @param array<class-string<object>> $unresolvableTypes */
    public function __construct(
        private readonly ContainerInterface $container,
        private readonly array $unresolvableTypes = [
            DateTimeImmutable::class,
            DateTime::class,
            DateTimeInterface::class,
            Validator::class,
        ],
    ) {
    }

    /**
     * @param array<int|string, mixed> $arguments
     *
     * @return array<int|string, mixed>
     */
    public function resolve(ReflectionFunctionAbstract $function, array $arguments): array
    {
        if (count($arguments) >= $function->getNumberOfParameters()) {
            return $arguments;
        }

        $injectableParameters = $this->injectableParameters($function);
        if ($injectableParameters === []) {
            return $arguments;
        }

        $positionalArgumentsCount = count(
            array_is_list($arguments) ? $arguments : array_filter(array_keys($arguments), is_int(...)),
        );

        foreach ($injectableParameters as [$position, $name, $type]) {
            if ($position < $positionalArgumentsCount || array_key_exists($name, $arguments)) {
                continue;
            }

            if (!$this->container->has($type)) {
                continue;
            }

            $arguments[$name] = $this->container->get($type);
        }

        return $arguments;
    }

    /** @return list<array{int, string, class-string}> */
    private function injectableParameters(ReflectionFunctionAbstract $function): array
    {
        $cacheKey = $this->createCacheKey($function);
        if (isset($this->injectableParametersCache[$cacheKey])) {
            return $this->injectableParametersCache[$cacheKey];
        }

        $parameters = [];
        foreach ($function->getParameters() as $parameter) {
            $type = $parameter->getType();
            if ($parameter->isVariadic() || !$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                continue;
            }

            $typeName = $type->getName();
            if (!class_exists($typeName) && !interface_exists($typeName)) {
                continue;
            }

            if (in_array($typeName, $this->unresolvableTypes, true)) {
                continue;
            }

            $parameters[] = [$parameter->getPosition(), $parameter->getName(), $typeName];
        }

        return $this->injectableParametersCache[$cacheKey] = $parameters;
    }

    private function createCacheKey(ReflectionFunctionAbstract $function): string
    {
        if ($function instanceof ReflectionMethod) {
            return $function->class . '::' . $function->name;
        }

        if (!$function->isClosure()) {
            return $function->name;
        }

        $file = $function->getFileName() ?: 'internal';
        $line = $function->getStartLine() ?: 0;

        return $function->getName() . '@' . $file . ':' . $line;
    }
}
