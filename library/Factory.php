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

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Annotations\SimpleAnnotationReader;
use ReflectionClass;
use Respect\Validation\Exceptions\InvalidClassException;
use Respect\Validation\Exceptions\RuleException;
use Respect\Validation\Exceptions\RuleNotFoundException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Message\Template;
use Respect\Validation\Message\Templates;

/**
 * Factory to create rules.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.8.0
 */
final class Factory
{
    /**
     * @var string[]
     */
    private $namespaces;

    /**
     * @var ReflectionClass[]
     */
    private $reflections;

    /**
     * @var Reader
     */
    private $annotationReader;

    /**
     * @var self
     */
    private static $defaultInstance;

    /**
     * Initializes the rule with the defined namespaces.
     *
     * If the default namespace is not in the array, it will be add to the end
     * of the array.
     *
     * @param array $namespaces
     */
    public function __construct(array $namespaces = [])
    {
        if (!in_array(__NAMESPACE__, $namespaces)) {
            $namespaces[] = __NAMESPACE__;
        }

        class_exists(Template::class);
        class_exists(Templates::class);

        $this->namespaces = $namespaces;
        $this->annotationReader = new SimpleAnnotationReader();
        foreach ($namespaces as $namespace) {
            $this->annotationReader->addNamespace(rtrim($namespace, '\\').'\\Message');
        }
    }

    /**
     * Defines the default instance of the factory.
     *
     * @param Factory $factory
     */
    public static function setDefaultInstance(self $factory): void
    {
        self::$defaultInstance = $factory;
    }

    /**
     * Returns the default instance of the factory.
     *
     * @return self
     */
    public static function getDefaultInstance(): self
    {
        if (!self::$defaultInstance instanceof self) {
            self::$defaultInstance = new self();
        }

        return self::$defaultInstance;
    }

    /**
     * Returns a list of namespaces.
     *
     * @return array
     */
    public function getNamespaces(): array
    {
        return $this->namespaces;
    }

    /**
     * Creates a rule.
     *
     * @param string $ruleName
     * @param array $arguments
     *
     * @throws InvalidClassException
     * @throws RuleNotFoundException
     *
     * @return Rule
     */
    public function rule(string $ruleName, array $arguments = []): Rule
    {
        return $this->getRuleReflection($ruleName)->newInstanceArgs($arguments);
    }

    /**
     * Creates an exception.
     *
     * @param Message $message
     *
     * @return RuleException
     */
    public function exception(Message $message): RuleException
    {
        $reflection = $this->getExceptionReflection($message->getRuleName());

        return $reflection->newInstance($message->__toString());
    }

    /**
     * Creates a template.
     *
     * @param Result $result
     *
     * @return Template
     */
    public function template(Result $result): Template
    {
        $reflection = $this->getReflection(get_class($result->getRule()), Rule::class);

        /* @var Templates $templates */
        $templates = $this->annotationReader->getClassAnnotation($reflection, Templates::class)
            ?? Templates::getDefault();

        $templateId = $result->getProperties()[Result::TEMPLATE_KEY] ?? Template::DEFAULT_ID_VALUE;
        $templateList = $result->isInverted() ? $templates->inverted : $templates->regular;

        /* @var Template $template */
        foreach ($templateList as $template) {
            if ($template->id !== $templateId) {
                continue;
            }

            return $template;
        }

        return current($templateList);
    }

    /**
     * Create a message.
     *
     * @param Result $result
     * @param Template|null $template
     *
     * @return Message
     */
    public function message(Result $result, Template $template = null): Message
    {
        $ruleName = ltrim(mb_strrchr(get_class($result->getRule()), '\\'), '\\');
        $template = $template ?: $this->template($result);

        return new Message($ruleName, $template->message, $result->getInput(), $result->getProperties());
    }

    /**
     * Returns a reflection of a rule based on its name.
     *
     * @param string $ruleName
     *
     * @throws RuleNotFoundException
     *
     * @return ReflectionClass
     */
    private function getRuleReflection(string $ruleName): ReflectionClass
    {
        foreach ($this->getNamespaces() as $namespace) {
            $className = rtrim($namespace, '\\').'\\Rules\\'.ucfirst($ruleName);
            if (!class_exists($className)) {
                continue;
            }

            return $this->getReflection($className, Rule::class);
        }

        throw new RuleNotFoundException(sprintf('Could not find "%s" rule', $ruleName));
    }

    /**
     * Returns a reflection of an exception based on a rule name.
     *
     * @param string $ruleName
     *
     * @return ReflectionClass
     */
    private function getExceptionReflection(string $ruleName): ReflectionClass
    {
        foreach ($this->getNamespaces() as $namespace) {
            $className = sprintf('%s\\Exceptions\\%sException', rtrim($namespace, '\\'), $ruleName);
            if (!class_exists($className)) {
                continue;
            }

            return $this->getReflection($className, RuleException::class);
        }

        return $this->getReflection(ValidationException::class, RuleException::class);
    }

    /**
     * Creates a ReflectionClass object based on a class name.
     *
     * This method always return the same object for a given class name in order
     * to improve performance. Also checks if the reflection is child of $parentClass
     * and if it is instantiable.
     *
     * @param string $className
     * @param string $parentClassName
     *
     * @throws InvalidClassException when not valid
     *
     * @return ReflectionClass
     */
    private function getReflection(string $className, string $parentClassName): ReflectionClass
    {
        if (!isset($this->reflections[$className])) {
            $this->reflections[$className] = new ReflectionClass($className);

            if (!$this->reflections[$className]->isInstantiable()) {
                throw new InvalidClassException(sprintf('"%s" is not instantiable', $className));
            }
        }

        if (!$this->reflections[$className]->isSubclassOf($parentClassName)) {
            throw new InvalidClassException(sprintf('"%s" is not subclass of "%s"', $className, $parentClassName));
        }

        return $this->reflections[$className];
    }
}
