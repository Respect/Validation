<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Exceptions;

use IteratorAggregate;
use RecursiveIteratorIterator;
use SplObjectStorage;

class NestedValidationException extends ValidationException implements IteratorAggregate
{
    /**
     * @var SplObjectStorage
     */
    private $exceptions = [];

    /**
     * @param ValidationException $exception
     *
     * @return self
     */
    public function addRelated(ValidationException $exception)
    {
        $this->getRelated()->attach($exception);

        return $this;
    }

    /**
     * @param array $paths
     *
     * @return self
     */
    public function findMessages(array $paths)
    {
        $messages = [];

        foreach ($paths as $key => $value) {
            $numericKey = is_numeric($key);
            $path = $numericKey ? $value : $key;

            $exception = $this->findRelated($path);

            if (is_object($exception) && !$numericKey) {
                $exception->setTemplate($value);
            }

            $path = str_replace('.', '_', $path);
            $messages[$path] = $exception ? $exception->getMainMessage() : '';
        }

        return $messages;
    }

    /**
     * @return Exception
     */
    public function findRelated($path)
    {
        $target = $this;
        $pieces = explode('.', $path);

        while (!empty($pieces) && $target) {
            $piece = array_shift($pieces);
            $target = $target->getRelatedByName($piece);
        }

        return $target;
    }

    /**
     * @return RecursiveIteratorIterator
     */
    private function getRecursiveIterator()
    {
        $exceptionIterator = new RecursiveExceptionIterator($this);
        $recursiveIteratorIterator = new RecursiveIteratorIterator(
            $exceptionIterator,
            RecursiveIteratorIterator::SELF_FIRST
        );

        return $recursiveIteratorIterator;
    }

    /**
     * @return SplObjectStorage
     */
    public function getIterator()
    {
        $childrenExceptions = new SplObjectStorage();

        $recursiveIteratorIterator = $this->getRecursiveIterator();
        $exceptionIterator = $recursiveIteratorIterator->getInnerIterator();

        $lastDepth = 0;
        $lastDepthOriginal = 0;
        $knownDepths = [];
        foreach ($recursiveIteratorIterator as $childException) {
            if ($childException instanceof self
                && $childException->getRelated()->count() > 0
                && $childException->getRelated()->count() < 2) {
                continue;
            }

            $currentDepth = $lastDepth;
            $currentDepthOriginal = $recursiveIteratorIterator->getDepth() + 1;

            if (isset($knownDepths[$currentDepthOriginal])) {
                $currentDepth = $knownDepths[$currentDepthOriginal];
            } elseif ($currentDepthOriginal > $lastDepthOriginal
                && ($this->hasCustomTemplate() || $exceptionIterator->count() != 1)) {
                ++$currentDepth;
            }

            if (!isset($knownDepths[$currentDepthOriginal])) {
                $knownDepths[$currentDepthOriginal] = $currentDepth;
            }

            $lastDepth = $currentDepth;
            $lastDepthOriginal = $currentDepthOriginal;

            $childrenExceptions->attach(
                $childException,
                [
                    'depth' => $currentDepth,
                    'depth_original' => $currentDepthOriginal,
                    'previous_depth' => $lastDepth,
                    'previous_depth_original' => $lastDepthOriginal,
                ]
            );
        }

        return $childrenExceptions;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        $messages = [$this->getMessage()];
        foreach ($this as $exception) {
            $messages[] = $exception->getMessage();
        }

        if (count($messages) > 1) {
            array_shift($messages);
        }

        return $messages;
    }

    /**
     * @return string
     */
    public function getFullMessage()
    {
        $marker = '-';
        $messages = [];
        $exceptions = $this->getIterator();

        if ($this->hasCustomTemplate() || count($exceptions) != 1) {
            $messages[] = sprintf('%s %s', $marker, $this->getMessage());
        }

        foreach ($exceptions as $exception) {
            $depth = $exceptions[$exception]['depth'];
            $prefix = str_repeat(' ', $depth * 2);
            $messages[] = sprintf('%s%s %s', $prefix, $marker, $exception->getMessage());
        }

        return implode(PHP_EOL, $messages);
    }

    /**
     * @return SplObjectStorage
     */
    public function getRelated()
    {
        if (!$this->exceptions instanceof SplObjectStorage) {
            $this->exceptions = new SplObjectStorage();
        }

        return $this->exceptions;
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return self
     */
    public function setParam($name, $value)
    {
        if ('translator' === $name) {
            foreach ($this->getRelated() as $exception) {
                $exception->setParam($name, $value);
            }
        }

        parent::setParam($name, $value);

        return $this;
    }

    /**
     * @return bool
     */
    private function isRelated($name, ValidationException $exception)
    {
        return ($exception->getId() === $name || $exception->getName() === $name);
    }

    /**
     * @return ValidationException
     */
    public function getRelatedByName($name)
    {
        if ($this->isRelated($name, $this)) {
            return $this;
        }

        foreach ($this->getRecursiveIterator() as $exception) {
            if ($this->isRelated($name, $exception)) {
                return $exception;
            }
        }
    }

    /**
     * @param array $exceptions
     *
     * @return self
     */
    public function setRelated(array $exceptions)
    {
        foreach ($exceptions as $exception) {
            $this->addRelated($exception);
        }

        return $this;
    }
}
