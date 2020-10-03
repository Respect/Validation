<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation;

use ReflectionClass;
use ReflectionException;
use ReflectionObject;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidClassException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Message\Formatter;
use Respect\Validation\Message\ParameterStringifier;
use Respect\Validation\Message\Stringifier\KeepOriginalStringName;

use function array_merge;
use function lcfirst;
use function sprintf;
use function str_replace;
use function trim;
use function ucfirst;

/**
 * Factory of objects.
 *
 * @author Augusto Pascutti <augusto@phpsp.org.br>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Factory
{
    /**
     * @var string[]
     */
    private $rulesNamespaces = ['Respect\\Validation\\Rules'];

    /**
     * @var string[]
     */
    private $exceptionsNamespaces = ['Respect\\Validation\\Exceptions'];

    /**
     * @var callable
     */
    private $translator = 'strval';

    /**
     * @var ParameterStringifier
     */
    private $parameterStringifier;

    /**
     * Default instance of the Factory.
     *
     * @var Factory
     */
    private static $defaultInstance;

    public function __construct()
    {
        $this->parameterStringifier = new KeepOriginalStringName();
    }

    /**
     * Returns the default instance of the Factory.
     */
    public static function getDefaultInstance(): self
    {
        if (self::$defaultInstance === null) {
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

    public function withExceptionNamespace(string $exceptionsNamespace): self
    {
        $clone = clone $this;
        $clone->exceptionsNamespaces[] = trim($exceptionsNamespace, '\\');

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
     * Creates a rule.
     *
     * @param mixed[] $arguments
     *
     * @throws ComponentException
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
     * Creates an exception.
     *
     * @param mixed $input
     * @param mixed[] $extraParams
     *
     * @throws ComponentException
     */
    public function exception(Validatable $validatable, $input, array $extraParams = []): ValidationException
    {
        $formatter = new Formatter($this->translator, $this->parameterStringifier);
        $reflection = new ReflectionObject($validatable);
        $ruleName = $reflection->getShortName();
        $params = ['input' => $input] + $extraParams + $this->extractPropertiesValues($validatable, $reflection);
        $id = lcfirst($ruleName);
        if ($validatable->getName() !== null) {
            $id = $params['name'] = $validatable->getName();
        }
        $exceptionNamespace = str_replace('\\Rules', '\\Exceptions', $reflection->getNamespaceName());
        foreach (array_merge([$exceptionNamespace], $this->exceptionsNamespaces) as $namespace) {
            try {
                /** @var class-string<ValidationException> $exceptionName */
                $exceptionName = $namespace . '\\' . $ruleName . 'Exception';

                return $this->createValidationException(
                    $exceptionName,
                    $id,
                    $input,
                    $params,
                    $formatter
                );
            } catch (ReflectionException $exception) {
                continue;
            }
        }

        return new ValidationException($input, $id, $params, $formatter);
    }

    /**
     * Define the default instance of the Factory.
     */
    public static function setDefaultInstance(self $defaultInstance): void
    {
        self::$defaultInstance = $defaultInstance;
    }

    /**
     * Creates a reflection based on class name.
     *
     * @param class-string $name
     * @param class-string $parentName
     *
     * @throws InvalidClassException
     * @throws ReflectionException
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

    /**
     * Creates a Validation exception.
     *
     * @param class-string<ValidationException> $exceptionName
     *
     * @param mixed $input
     * @param mixed[] $params
     *
     * @throws InvalidClassException
     * @throws ReflectionException
     */
    private function createValidationException(
        string $exceptionName,
        string $id,
        $input,
        array $params,
        Formatter $formatter
    ): ValidationException {
        /** @var ValidationException $exception */
        $exception = $this
            ->createReflectionClass($exceptionName, ValidationException::class)
            ->newInstance($input, $id, $params, $formatter);
        if (isset($params['template'])) {
            $exception->updateTemplate($params['template']);
        }

        return $exception;
    }

    /**
     * @return mixed[]
     */
    private function extractPropertiesValues(Validatable $validatable, ReflectionClass $reflection): array
    {
        $values = [];
        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);

            $propertyValue = $property->getValue($validatable);
            if ($propertyValue === null) {
                continue;
            }

            $values[$property->getName()] = $propertyValue;
        }

        $parentReflection = $reflection->getParentClass();
        if ($parentReflection !== false) {
            return $values + $this->extractPropertiesValues($validatable, $parentReflection);
        }

        return $values;
    }
}
