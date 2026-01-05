<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use ReflectionClass;
use ReflectionException;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidClassException;
use Respect\Validation\Transformers\RuleSpec;
use Respect\Validation\Transformers\Transformer;

use function array_merge;
use function sprintf;
use function trim;
use function ucfirst;

final readonly class NamespacedRuleFactory implements RuleFactory
{
    /** @param array<int, string> $rulesNamespaces */
    public function __construct(
        private Transformer $transformer,
        private array $rulesNamespaces,
    ) {
    }

    public function withRuleNamespace(string $rulesNamespace): self
    {
        return clone ($this, ['rulesNamespaces' => [trim($rulesNamespace, '\\'), ...$this->rulesNamespaces]]);
    }

    /** @param array<int, mixed> $arguments */
    public function create(string $ruleName, array $arguments = []): Validator
    {
        return $this->createRuleSpec($this->transformer->transform(new RuleSpec($ruleName, $arguments)));
    }

    private function createRuleSpec(RuleSpec $ruleSpec): Validator
    {
        $validator = $this->createRule($ruleSpec->name, $ruleSpec->arguments);
        if ($ruleSpec->wrapper !== null) {
            return $this->createRule(
                $ruleSpec->wrapper->name,
                array_merge($ruleSpec->wrapper->arguments, [$validator]),
            );
        }

        return $validator;
    }

    /** @param array<int, mixed> $arguments */
    private function createRule(string $ruleName, array $arguments = []): Validator
    {
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

                return $reflection->newInstanceArgs($arguments);
            } catch (ReflectionException) {
                continue;
            }
        }

        throw new ComponentException(sprintf('"%s" is not a valid rule name', $ruleName));
    }
}
