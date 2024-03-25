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
use Respect\Validation\Message\Parameter\Processor;
use Respect\Validation\Message\Parameter\Raw;
use Respect\Validation\Message\Parameter\Stringify;
use Respect\Validation\Message\Parameter\Trans;
use Respect\Validation\Transformers\Aliases;
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

    /**
     * @var callable
     */
    private $translator;

    private Processor $processor;

    private Transformer $transformer;

    private static Factory $defaultInstance;

    public function __construct()
    {
        $this->translator = static fn (string $message) => $message;
        $this->processor = new Raw(new Trans($this->translator, new Stringify()));
        $this->transformer = new DeprecatedAttribute(
            new DeprecatedKey(
                new DeprecatedKeyValue(
                    new DeprecatedMinAndMax(
                        new DeprecatedKeyNested(new DeprecatedLength(new DeprecatedType(new Aliases(new Prefix()))))
                    )
                )
            )
        );
    }

    public static function getDefaultInstance(): self
    {
        if (!isset(self::$defaultInstance)) {
            self::$defaultInstance = new self();
        }

        return self::$defaultInstance;
    }

    public function withRuleNamespace(string $rulesNamespace): self
    {
        $clone = clone $this;
        $clone->rulesNamespaces[] = trim($rulesNamespace, '\\');

        return $clone;
    }

    public function withTranslator(callable $translator): self
    {
        $clone = clone $this;
        $clone->translator = $translator;
        $clone->processor = new Raw(new Trans($translator, new Stringify()));

        return $clone;
    }

    public function withParameterProcessor(Processor $processor): self
    {
        $clone = clone $this;
        $clone->processor = $processor;

        return $clone;
    }

    public function getTranslator(): callable
    {
        return $this->translator;
    }

    public function getParameterProcessor(): Processor
    {
        return $this->processor;
    }

    /**
     * @param mixed[] $arguments
     */
    public function rule(string $ruleName, array $arguments = []): Validatable
    {
        return $this->createRuleSpec($this->transformer->transform(new RuleSpec($ruleName, $arguments)));
    }

    public static function setDefaultInstance(self $defaultInstance): void
    {
        self::$defaultInstance = $defaultInstance;
    }

    private function createRuleSpec(RuleSpec $ruleSpec): Validatable
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
    private function createRule(string $ruleName, array $arguments = []): Validatable
    {
        foreach ($this->rulesNamespaces as $namespace) {
            try {
                /** @var class-string<Validatable> $name */
                $name = $namespace . '\\' . ucfirst($ruleName);
                $reflection = new ReflectionClass($name);
                if (!$reflection->isSubclassOf(Validatable::class)) {
                    throw new InvalidClassException(
                        sprintf('"%s" must be an instance of "%s"', $name, Validatable::class)
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
