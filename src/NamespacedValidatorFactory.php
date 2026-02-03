<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use ReflectionClass;
use ReflectionException;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidClassException;
use Respect\Validation\Transformers\Transformer;
use Respect\Validation\Transformers\ValidatorSpec;

use function array_merge;
use function Respect\Stringifier\stringify;
use function sprintf;
use function trim;
use function ucfirst;

final readonly class NamespacedValidatorFactory implements ValidatorFactory
{
    /** @param array<int, string> $rulesNamespaces */
    public function __construct(
        private Transformer $transformer,
        private array $rulesNamespaces,
    ) {
    }

    public function withNamespace(string $rulesNamespace): self
    {
        return clone ($this, ['rulesNamespaces' => [trim($rulesNamespace, '\\'), ...$this->rulesNamespaces]]);
    }

    /** @param array<int, mixed> $arguments */
    public function create(string $ruleName, array $arguments = []): Validator
    {
        return $this->createValidatorSpec($this->transformer->transform(new ValidatorSpec($ruleName, $arguments)));
    }

    private function createValidatorSpec(ValidatorSpec $validatorSpec): Validator
    {
        $validator = $this->createRule($validatorSpec->name, $validatorSpec->arguments);
        if ($validatorSpec->wrapper !== null) {
            return $this->createRule(
                $validatorSpec->wrapper->name,
                array_merge($validatorSpec->wrapper->arguments, [$validator]),
            );
        }

        return $validator;
    }

    /** @param array<int, mixed> $arguments */
    private function createRule(string $ruleName, array $arguments = []): Validator
    {
        $reflection = null;

        foreach ($this->rulesNamespaces as $namespace) {
            try {
                /** @var class-string<Validator> $name */
                $name = $namespace . '\\' . ucfirst($ruleName);
                $reflection = new ReflectionClass($name);
                if (!$reflection->isSubclassOf(Validator::class)) {
                    throw new InvalidClassException(
                        sprintf('"%s" must be an instance of "%s"', $name, Validator::class),
                    );
                }

                if (!$reflection->isInstantiable()) {
                    throw new InvalidClassException(sprintf('"%s" must be instantiable', $name));
                }

                break;
            } catch (ReflectionException) {
                continue;
            }
        }

        if (!$reflection) {
            throw new ComponentException(sprintf('"%s" is not a valid rule name', $ruleName));
        }

        try {
            return $reflection->newInstanceArgs($arguments);
        } catch (ReflectionException) {
            throw new InvalidClassException(
                sprintf('"%s" could not be instantiated with arguments %s', $ruleName, stringify($arguments)),
            );
        }
    }
}
