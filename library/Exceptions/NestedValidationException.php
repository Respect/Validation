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

namespace Respect\Validation\Exceptions;

use IteratorAggregate;
use RecursiveIteratorIterator;
use SplObjectStorage;
use const PHP_EOL;
use function count;
use function implode;
use function is_array;
use function str_repeat;

/**
 * Exception for nested validations.
 *
 * This exception allows to have exceptions inside itself and providers methods
 * to handle them and to retrieve nested messages based on itself and its
 * children.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jonathan Stewmon <jstewmon@rmn.com>
 * @author Wojciech Frącz <fraczwojciech@gmail.com>
 */
class NestedValidationException extends ValidationException implements IteratorAggregate
{
    /**
     * @var SplObjectStorage
     */
    private $exceptions;

    /**
     * Returns the exceptions that are children of the exception.
     *
     * @return SplObjectStorage|ValidationException[]
     */
    public function getChildren(): SplObjectStorage
    {
        if (!$this->exceptions instanceof SplObjectStorage) {
            $this->exceptions = new SplObjectStorage();
        }

        return $this->exceptions;
    }

    /**
     * Adds a child to the exception.
     *
     * @param ValidationException $exception
     *
     * @return self
     */
    public function addChild(ValidationException $exception): self
    {
        $this->getChildren()->attach($exception);

        return $this;
    }

    /**
     * Adds children to the exception.
     *
     * @param ValidationException[] $exceptions
     *
     * @return self
     */
    public function addChildren(array $exceptions): self
    {
        foreach ($exceptions as $exception) {
            $this->addChild($exception);
        }

        return $this;
    }

    /**
     * @return SplObjectStorage
     */
    public function getIterator(): SplObjectStorage
    {
        $childrenExceptions = new SplObjectStorage();
        $recursiveIteratorIterator = $this->getRecursiveIterator();

        $lastDepth = 0;
        $lastDepthOriginal = 0;
        $knownDepths = [];
        foreach ($recursiveIteratorIterator as $childException) {
            if ($this->isOmissible($childException)) {
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

            $childrenExceptions->attach($childException, $currentDepth);
        }

        return $childrenExceptions;
    }

    /**
     * Returns a key->value array with all the messages of the exception.
     *
     * In this array the "keys" are the ids of the exceptions (defined name or
     * name of the rule) and the values are the message.
     *
     * Once templates are passed it overwrites the templates of the given
     * messages.
     *
     * @param array $templates
     *
     * @return array
     */
    public function getMessages(array $templates = []): array
    {
        $messages = [$this->getId() => $this->renderMessage($this, $templates)];
        foreach ($this->getChildren() as $exception) {
            $id = $exception->getId();
            if (!$exception instanceof self) {
                $messages[$id] = $this->renderMessage(
                    $exception,
                    $this->findTemplates($templates, $this->getId())
                );
                continue;
            }

            $messages[$id] = $exception->getMessages($this->findTemplates($templates, $id, $this->getId()));
            if (count($messages[$id]) > 1) {
                continue;
            }

            $messages[$id] = current($messages[$exception->getId()]);
        }

        if (count($messages) > 1) {
            unset($messages[$this->getId()]);
        }

        return $messages;
    }

    /**
     * Returns a string with all the messages of the exception.
     *
     * @return string
     */
    public function getFullMessage(): string
    {
        $messages = [];
        $leveler = 1;

        if (!$this->isOmissible($this)) {
            $leveler = 0;
            $messages[] = sprintf('- %s', $this->getMessage());
        }

        $exceptions = $this->getIterator();
        foreach ($exceptions as $exception) {
            $messages[] = sprintf(
                '%s- %s',
                str_repeat(' ', ($exceptions[$exception] - $leveler) * 2),
                $exception->getMessage()
            );
        }

        return implode(PHP_EOL, $messages);
    }

    private function getRecursiveIterator(): RecursiveIteratorIterator
    {
        return new RecursiveIteratorIterator(
            new RecursiveExceptionIterator($this),
            RecursiveIteratorIterator::SELF_FIRST
        );
    }

    private function isOmissible(Exception $exception): bool
    {
        if (!$exception instanceof self) {
            return false;
        }

        if (1 !== $exception->getChildren()->count()) {
            return false;
        }

        $exception->getChildren()->rewind();
        $childException = $exception->getChildren()->current();
        if ($childException->getMessage() === $exception->getMessage()) {
            return true;
        }

        if ($exception->hasCustomTemplate()) {
            return $childException->hasCustomTemplate();
        }

        return !$childException instanceof NonOmissibleException;
    }

    private function renderMessage(ValidationException $exception, array $templates): string
    {
        if (isset($templates[$exception->getId()])) {
            $exception->updateTemplate($templates[$exception->getId()]);
        }

        return $exception->getMessage();
    }

    private function findTemplates(array $templates, ...$ids): array
    {
        while (count($ids) > 0) {
            $id = array_shift($ids);
            if (isset($templates[$id]) && is_array($templates[$id])) {
                $templates = $templates[$id];
            }
        }

        return $templates;
    }
}
