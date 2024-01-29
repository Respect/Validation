<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use ReflectionClass;
use ReflectionException;
use ReflectionObject;
use Respect\Validation\Attributes\ExceptionClass;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidClassException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Message\Formatter;
use Respect\Validation\Message\ParameterStringifier;
use Respect\Validation\Message\Stringifier\KeepOriginalStringName;
use Respect\Validation\Message\TemplateCollector;

use function count;
use function lcfirst;
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
    private $translator = 'strval';

    private ParameterStringifier $parameterStringifier;

    private TemplateCollector $templateCollector;

    private static Factory $defaultInstance;

    public function __construct()
    {
        $this->parameterStringifier = new KeepOriginalStringName();
        $this->templateCollector = new TemplateCollector();
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

        return $clone;
    }

    public function withParameterStringifier(ParameterStringifier $parameterStringifier): self
    {
        $clone = clone $this;
        $clone->parameterStringifier = $parameterStringifier;

        return $clone;
    }

    /**
     * @param mixed[] $arguments
     */
    public function rule(string $ruleName, array $arguments = []): Validatable
    {
        foreach ($this->rulesNamespaces as $namespace) {
            try {
                /** @var class-string<Validatable> $name */
                $name = $namespace . '\\' . ucfirst($ruleName);
                /** @var Validatable $rule */
                $rule = $this
                    ->createReflectionClass($name, Validatable::class)
                    ->newInstanceArgs($arguments);

                return $rule;
            } catch (ReflectionException $exception) {
                continue;
            }
        }

        throw new ComponentException(sprintf('"%s" is not a valid rule name', $ruleName));
    }

    /**
     * @param mixed[] $extraParams
     */
    public function exception(Validatable $validatable, mixed $input, array $extraParams = []): ValidationException
    {
        $reflection = new ReflectionObject($validatable);

        $params = ['input' => $input] + $extraParams + $validatable->getParams();
        $id = lcfirst($reflection->getShortName());
        if ($validatable->getName() !== null) {
            $id = $params['name'] = $validatable->getName();
        }
        $template = $validatable->getTemplate($input);
        $templates = $this->templateCollector->extract($validatable);
        $formatter = new Formatter($this->translator, $this->parameterStringifier);

        $attributes = $reflection->getAttributes(ExceptionClass::class);
        if (count($attributes) === 0) {
            return new ValidationException($input, $id, $params, $template, $templates, $formatter);
        }

        /** @var ValidationException $exception */
        $exception = $this
            ->createReflectionClass($attributes[0]->newInstance()->class, ValidationException::class)
            ->newInstance($input, $id, $params, $template, $templates, $formatter);

        return $exception;
    }

    public static function setDefaultInstance(self $defaultInstance): void
    {
        self::$defaultInstance = $defaultInstance;
    }

    /**
     * @param class-string $name
     * @param class-string $parentName
     *
     * @return ReflectionClass<ValidationException|Validatable|object>
     */
    private function createReflectionClass(string $name, string $parentName): ReflectionClass
    {
        $reflection = new ReflectionClass($name);
        if (!$reflection->isSubclassOf($parentName) && $parentName !== $name) {
            throw new InvalidClassException(sprintf('"%s" must be an instance of "%s"', $name, $parentName));
        }

        if (!$reflection->isInstantiable()) {
            throw new InvalidClassException(sprintf('"%s" must be instantiable', $name));
        }

        return $reflection;
    }
}
