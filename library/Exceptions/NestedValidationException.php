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
use function count;
use function is_array;

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
     * Returns weather an exception should be omitted or not.
     *
     * @param Exception $exception
     *
     * @return bool
     */
    private function isOmissible(Exception $exception)
    {
        if (!$exception instanceof self) {
            return false;
        }

        $relatedExceptions = $exception->getRelated();
        $relatedExceptions->rewind();
        $childException = $relatedExceptions->current();

        return 1 === $relatedExceptions->count() && !$childException instanceof NonOmissibleException;
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
    public function getIterator()
    {
        $childrenExceptions = new SplObjectStorage();

        $recursiveIteratorIterator = $this->getRecursiveIterator();
        $exceptionIterator = $recursiveIteratorIterator->getInnerIterator();

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

    public function getMessages(array $templates = []): array
    {
        $messages = [$this->getId() => $this->renderMessage($this, $templates)];
        foreach ($this->getRelated() as $exception) {
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
     * @return SplObjectStorage|ValidationException[]
     */
    public function getRelated()
    {
        if (!$this->exceptions instanceof SplObjectStorage) {
            $this->exceptions = new SplObjectStorage();
        }

        return $this->exceptions;
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
