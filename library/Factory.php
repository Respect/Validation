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
use Respect\Validation\Transformers\Aliases;
use Respect\Validation\Transformers\DeprecatedAge;
use Respect\Validation\Transformers\DeprecatedAttribute;
use Respect\Validation\Transformers\DeprecatedKey;
use Respect\Validation\Transformers\DeprecatedKeyNested;
use Respect\Validation\Transformers\DeprecatedKeyValue;
use Respect\Validation\Transformers\DeprecatedLength;
use Respect\Validation\Transformers\DeprecatedMinAndMax;
use Respect\Validation\Transformers\DeprecatedType;
use Respect\Validation\Transformers\Prefix;
use Respect\Validation\Transformers\RuleSpec;
use Respect\Validation\Transformers\Transformer;

use function array_merge;
use function sprintf;
use function trim;
use function ucfirst;

final class Factory
{
    /**
     * @var string[]
     */
    private array $rulesNamespaces = ['Respect\\Validation\\Rules'];

    public function __construct(
        private readonly Transformer $transformer = new DeprecatedAttribute(
            new DeprecatedKey(
                new DeprecatedKeyValue(
                    new DeprecatedMinAndMax(
                        new DeprecatedAge(
                            new DeprecatedKeyNested(new DeprecatedLength(new DeprecatedType(new Aliases(new Prefix()))))
                        )
                    )
                )
            )
        )
    ) {
    }

    public function withRuleNamespace(string $rulesNamespace): self
    {
        $clone = clone $this;
        $clone->rulesNamespaces[] = trim($rulesNamespace, '\\');

        return $clone;
    }

    /**
     * @param mixed[] $arguments
     */
    public function rule(string $ruleName, array $arguments = []): Rule
    {
        return $this->createRuleSpec($this->transformer->transform(new RuleSpec($ruleName, $arguments)));
    }

    private function createRuleSpec(RuleSpec $ruleSpec): Rule
    {
        $rule = $this->createRule($ruleSpec->name, $ruleSpec->arguments);
        if ($ruleSpec->wrapper !== null) {
            return $this->createRule($ruleSpec->wrapper->name, array_merge($ruleSpec->wrapper->arguments, [$rule]));
        }

        return $rule;
    }

    /**
     * @param mixed[] $arguments
     */
    private function createRule(string $ruleName, array $arguments = []): Rule
    {
        foreach ($this->rulesNamespaces as $namespace) {
            try {
                /** @var class-string<Rule> $name */
                $name = $namespace . '\\' . ucfirst($ruleName);
                $reflection = new ReflectionClass($name);
                if (!$reflection->isSubclassOf(Rule::class)) {
                    throw new InvalidClassException(
                        sprintf('"%s" must be an instance of "%s"', $name, Rule::class)
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
