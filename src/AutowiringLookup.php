<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Fluent\Exceptions\CouldNotCreate;
use Respect\Fluent\Factories\NamespaceLookup;
use Respect\Fluent\FluentFactory;
use Respect\Fluent\FluentNode;
use Respect\Fluent\FluentResolver;
use Respect\Parameter\Resolver;
use Throwable;

use function sprintf;

final readonly class AutowiringLookup implements FluentFactory
{
    public function __construct(
        private NamespaceLookup $lookup,
        private FluentResolver $resolver,
        private Resolver $parameterResolver,
    ) {
    }

    public function withNamespace(string $namespace): static
    {
        return clone ($this, ['lookup' => $this->lookup->withNamespace($namespace)]);
    }

    /** @param array<int|string, mixed> $arguments */
    public function create(string $name, array $arguments = []): object
    {
        $spec = $this->resolver->resolve(new FluentNode($name, $arguments));

        $instance = $this->instantiate($spec->name, $spec->arguments);

        $wrapper = $spec->wrapper;
        while ($wrapper !== null) {
            $instance = $this->instantiate($wrapper->name, [...$wrapper->arguments, $instance]);
            $wrapper = $wrapper->wrapper;
        }

        return $instance;
    }

    /** @param array<int|string, mixed> $arguments */
    private function instantiate(string $name, array $arguments): object
    {
        $reflection = $this->lookup->resolve($name);

        $constructor = $reflection->getConstructor();
        try {
            if ($constructor === null) {
                return $reflection->newInstanceArgs($arguments);
            }

            return $reflection->newInstanceArgs($this->parameterResolver->resolve($constructor, $arguments));
        } catch (Throwable $exception) {
            throw new CouldNotCreate(
                sprintf('Could not instantiate "%s": %s', $name, $exception->getMessage()),
                previous: $exception,
            );
        }
    }
}
