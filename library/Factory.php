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

use ReflectionClass;
use ReflectionException;
use ReflectionObject;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidClassException;
use Respect\Validation\Exceptions\ValidationException;
use function array_map;
use function array_merge;
use function array_unique;
use function lcfirst;

/**
 * Factory of objects.
 *
 * @author Augusto Pascutti <augusto@phpsp.org.br>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Factory
{
    private const DEFAULT_RULES_NAMESPACES = [
        'Respect\\Validation\\Rules',
        'Respect\\Validation\\Rules\\Locale',
    ];

    private const DEFAULT_EXCEPTIONS_NAMESPACES = [
        'Respect\\Validation\\Exceptions',
        'Respect\\Validation\\Exceptions\\Locale',
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
     * @var callable
     */
    private $translator;

    /**
     * Initializes the factory with the defined namespaces.
     *
     * If the default namespace is not in the array, it will be add to the end
     * of the array.
     *
     * @param string[] $rulesNamespaces
     * @param string[] $exceptionsNamespaces
     */
    public function __construct(
        array $rulesNamespaces,
        array $exceptionsNamespaces,
        callable $translator
    ) {
        $this->rulesNamespaces = $this->filterNamespaces(
            $rulesNamespaces,
            self::DEFAULT_RULES_NAMESPACES
        );
        $this->exceptionsNamespaces = $this->filterNamespaces(
            $exceptionsNamespaces,
            self::DEFAULT_EXCEPTIONS_NAMESPACES
        );
        $this->translator = $translator;
    }

    /**
     * Define the default instance of the Factory.
     */
    public static function setDefaultInstance(self $defaultInstance): void
    {
        self::$defaultInstance = $defaultInstance;
    }

    /**
     * Returns the default instance of the Factory.
     */
    public static function getDefaultInstance(): self
    {
        if (null === self::$defaultInstance) {
            self::$defaultInstance = new self(
                self::DEFAULT_RULES_NAMESPACES,
                self::DEFAULT_EXCEPTIONS_NAMESPACES,
                function (string $message): string {
                    return $message;
                }
            );
        }

        return self::$defaultInstance;
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
                /** @var Validatable $rule */
                $rule = $this
                    ->createReflectionClass($namespace.'\\'.ucfirst($ruleName), Validatable::class)
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
        $reflection = new ReflectionObject($validatable);
        $ruleName = $reflection->getShortName();
        $params = ['input' => $input] + $extraParams + $this->extractPropertiesValues($validatable, $reflection);
        $id = lcfirst($ruleName);
        if ($validatable->getName()) {
            $id = $params['name'] = $validatable->getName();
        }
        foreach ($this->exceptionsNamespaces as $namespace) {
            try {
                return $this->createValidationException($namespace.'\\'.$ruleName.'Exception', $id, $input, $params);
            } catch (ReflectionException $exception) {
                continue;
            }
        }

        return new ValidationException($input, $id, $params, $this->translator);
    }

    /**
     * Creates a reflection based on class name.
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
     * Filters namespaces.
     *
     * Ensure namespaces are in the right format and contain the default namespaces.
     *
     * @param string[] $namespaces
     * @param string[] $defaultNamespaces
     *
     * @return string[]
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
        array $params
    ): ValidationException {
        /** @var ValidationException $exception */
        $exception = $this->createReflectionClass($exceptionName, ValidationException::class)
            ->newInstance($input, $id, $params, $this->translator);
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
            if (null === $propertyValue) {
                continue;
            }

            $values[$property->getName()] = $propertyValue;
        }

        $parentReflection = $reflection->getParentClass();
        if (false !== $parentReflection) {
            return $values + $this->extractPropertiesValues($validatable, $parentReflection);
        }

        return $values;
    }
}
