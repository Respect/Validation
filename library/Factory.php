<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation;

use function array_map;
use function array_merge;
use function array_unique;
use function class_exists;
use function lcfirst;
use function Respect\Stringifier\stringify;
use ReflectionClass;
use ReflectionObject;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidClassException;
use Respect\Validation\Exceptions\ValidationException;

/**
 * Factory of objects.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.8.0
 */
final class Factory
{
    private const DEFAULT_RULES_NAMESPACES = [
        'Respect\\Validation\\Rules',
        'Respect\\Validation\\Rules\\Locale',
        'Respect\\Validation\\Rules\\SubdivisionCode',
    ];

    private const DEFAULT_EXCEPTIONS_NAMESPACES = [
        'Respect\\Validation\\Exceptions',
        'Respect\\Validation\\Exceptions\\Locale',
        'Respect\\Validation\\Exceptions\\SubdivisionCode',
    ];

    /**
     * Default instance of the Factory.
     *
     * @var Factory
     */
    private static $defaultInstance;

    /**
     * @var string[]
     */
    private $rulesNamespaces = [];

    /**
     * @var string[]
     */
    private $exceptionsNamespaces = [];

    /**
     * Initializes the factory with the defined namespaces.
     *
     * If the default namespace is not in the array, it will be add to the end
     * of the array.
     *
     * @param string[] $rulesNamespaces
     * @param string[] $exceptionsNamespaces
     */
    public function __construct(array $rulesNamespaces, array $exceptionsNamespaces)
    {
        $this->rulesNamespaces = $this->filterNamespaces($rulesNamespaces, self::DEFAULT_RULES_NAMESPACES);
        $this->exceptionsNamespaces = $this->filterNamespaces($exceptionsNamespaces, self::DEFAULT_EXCEPTIONS_NAMESPACES);
    }

    /**
     * Define the default instance of the Factory.
     *
     * @param Factory $defaultInstance
     */
    public static function setDefaultInstance(self $defaultInstance): void
    {
        self::$defaultInstance = $defaultInstance;
    }

    /**
     * Returns the default instance of the Factory.
     *
     * @return Factory
     */
    public static function getDefaultInstance(): self
    {
        if (null === self::$defaultInstance) {
            self::$defaultInstance = new self(self::DEFAULT_RULES_NAMESPACES, self::DEFAULT_EXCEPTIONS_NAMESPACES);
        }

        return self::$defaultInstance;
    }

    /**
     * Creates a rule.
     *
     * @param string $ruleName
     * @param array $arguments
     *
     * @throws ComponentException
     *
     * @return Validatable
     */
    public function rule(string $ruleName, array $arguments = []): Validatable
    {
        foreach ($this->rulesNamespaces as $namespace) {
            $className = sprintf('%s\\%s', $namespace, ucfirst($ruleName));
            if (!class_exists($className)) {
                continue;
            }

            return $this->createReflectionClass($className, Validatable::class)->newInstanceArgs($arguments);
        }

        throw new ComponentException(sprintf('"%s" is not a valid rule name', $ruleName));
    }

    /**
     * Creates an exception.
     *
     *
     * @param Validatable $validatable
     * @param mixed $input
     * @param array $extraParams
     *
     * @throws ComponentException
     *
     * @return ValidationException
     */
    public function exception(Validatable $validatable, $input, array $extraParams = []): ValidationException
    {
        $reflection = new ReflectionObject($validatable);
        $ruleName = $reflection->getShortName();
        foreach ($this->exceptionsNamespaces as $namespace) {
            $exceptionName = sprintf('%s\\%sException', $namespace, $ruleName);
            if (!class_exists($exceptionName)) {
                continue;
            }

            $name = $validatable->getName() ?: stringify($input);
            $params = ['input' => $input] + $extraParams + $this->extractPropertiesValues($validatable, $reflection);

            return $this->createValidationException($exceptionName, $name, $params);
        }

        throw new ComponentException(sprintf('Cannot find exception for "%s" rule', lcfirst($ruleName)));
    }

    /**
     * Creates a reflection based on class name.
     *
     *
     * @param string $name
     * @param string $parentName
     *
     * @throws InvalidClassException
     *
     * @return ReflectionClass
     */
    private function createReflectionClass(string $name, string $parentName): ReflectionClass
    {
        $reflection = new ReflectionClass($name);
        if (!$reflection->isSubclassOf($parentName)) {
            throw new InvalidClassException(sprintf('"%s" must be an instance of "%s"', $name, $parentName));
        }

        if (!$reflection->isInstantiable()) {
            throw new InvalidClassException(sprintf('"%s" must be instantiable', $name));
        }

        return $reflection;
    }

    /**
     * Filters namespaces.
     *
     * Ensure namespaces are in the right format and contain the default namespaces.
     *
     * @param array $namespaces
     * @param array $defaultNamespaces
     *
     * @return array
     */
    private function filterNamespaces(array $namespaces, array $defaultNamespaces): array
    {
        $filter = function (string $namespace): string {
            return trim($namespace, '\\');
        };

        return array_unique(
            array_merge(
                array_map($filter, $namespaces),
                array_map($filter, $defaultNamespaces)
            )
        );
    }

    /**
     * Creates a Validation exception.
     *
     * @param string $exceptionName
     * @param mixed $name
     * @param array $params
     *
     * @return ValidationException
     */
    private function createValidationException(string $exceptionName, $name, array $params): ValidationException
    {
        $exception = $this->createReflectionClass($exceptionName, ValidationException::class)->newInstance();
        $exception->configure($name, $params);
        if (isset($params['template'])) {
            $exception->setTemplate($params['template']);
        }

        return $exception;
    }

    /**
     * @param Validatable $validatable
     * @param ReflectionObject $reflection
     *
     * @return array
     */
    private function extractPropertiesValues(Validatable $validatable, ReflectionObject $reflection): array
    {
        $values = [];
        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);

            $values[$property->getName()] = $property->getValue($validatable);
        }

        return $values;
    }
}
