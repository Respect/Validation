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
     * @param string $path
     * @param ValidationException $exception
     *
     * @return ValidationException
     */
    private function getExceptionForPath($path, ValidationException $exception)
    {
        if ($path === $exception->guessId()) {
            return $exception;
        }

        if (!$exception instanceof self) {
            return $exception;
        }

        foreach ($exception as $subException) {
            return $subException;
        }

        return $exception;
    }

    /**
     * @param array $paths
     *
     * @return array
     */
    public function findMessages(array $paths)
    {
        $messages = [];

        foreach ($paths as $key => $value) {
            $numericKey = is_numeric($key);
            $path = $numericKey ? $value : $key;

            if (!($exception = $this->getRelatedByName($path))) {
                $exception = $this->findRelated($path);
            }

            $path = str_replace('.', '_', $path);

            if (!$exception) {
                $messages[$path] = '';
                continue;
            }

            $exception = $this->getExceptionForPath($path, $exception);
            if (!$numericKey) {
                $exception->setTemplate($value);
            }

            $messages[$path] = $exception->getMainMessage();
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

    private function isSkippable(ValidationException $exception)
    {
        if (!$exception instanceof self) {
            return false;
        }

        if (1 !== $exception->getRelated()->count()) {
            return false;
        }

        if (!$exception->hasCustomTemplate()) {
            return true;
        }

        return $this->hasChildTemplate($exception);
    }

    private function hasChildTemplate(self $exception)
    {
        $exception->getRelated()->rewind();
        $childException = $exception->getRelated()->current();

        return $childException->getMessage() === $exception->getMessage();
    }

    /**
     * @return SplObjectStorage
     */
    #[\ReturnTypeWillChange]
    public function getIterator()
    {
        $childrenExceptions = new SplObjectStorage();

        $recursiveIteratorIterator = $this->getRecursiveIterator();
        $exceptionIterator = $recursiveIteratorIterator->getInnerIterator();

        $lastDepth = 0;
        $lastDepthOriginal = 0;
        $knownDepths = [];
        foreach ($recursiveIteratorIterator as $childException) {
            if ($this->isSkippable($childException)) {
                continue;
            }

            $currentDepth = $lastDepth;
            $currentDepthOriginal = $recursiveIteratorIterator->getDepth() + 1;

            if (isset($knownDepths[$currentDepthOriginal])) {
                $currentDepth = $knownDepths[$currentDepthOriginal];
            } elseif ($currentDepthOriginal > $lastDepthOriginal) {
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
        $messages = [];
        $leveler = 1;

        if (!$this->isSkippable($this)) {
            $leveler = 0;
            $messages[] = sprintf('- %s', $this->getMessage());
        }

        $exceptions = $this->getIterator();
        foreach ($exceptions as $exception) {
            $messages[] = sprintf(
                '%s- %s',
                str_repeat(' ', ($exceptions[$exception]['depth'] - $leveler) * 2),
                $exception->getMessage()
            );
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
