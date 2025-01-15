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
use Respect\Validation\Transformers\Deprecated\AgeRule;
use Respect\Validation\Transformers\Deprecated\AttributeRule;
use Respect\Validation\Transformers\Deprecated\CompositeArguments;
use Respect\Validation\Transformers\Deprecated\KeyArguments;
use Respect\Validation\Transformers\Deprecated\KeyNestedRule;
use Respect\Validation\Transformers\Deprecated\KeyValueRule;
use Respect\Validation\Transformers\Deprecated\LengthArguments;
use Respect\Validation\Transformers\Deprecated\MinAndMaxArguments;
use Respect\Validation\Transformers\Deprecated\SizeArguments;
use Respect\Validation\Transformers\Deprecated\TypeRule;
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
        private readonly Transformer $transformer = new AttributeRule(
            new KeyArguments(
                new KeyValueRule(
                    new MinAndMaxArguments(
                        new AgeRule(
                            new KeyNestedRule(
                                new LengthArguments(
                                    new TypeRule(new SizeArguments(new CompositeArguments(new Aliases(new Prefix()))))
                                )
                            )
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
