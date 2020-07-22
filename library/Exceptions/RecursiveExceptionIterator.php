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

namespace Respect\Validation\Exceptions;

use ArrayIterator;
use Countable;
use RecursiveIterator;
use UnexpectedValueException;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class RecursiveExceptionIterator implements RecursiveIterator, Countable
{
    /**
     * @var ArrayIterator<int, ValidationException>
     */
    private $exceptions;

    public function __construct(NestedValidationException $parent)
    {
        $this->exceptions = new ArrayIterator($parent->getChildren());
    }

    public function count(): int
    {
        return $this->exceptions->count();
    }

    public function hasChildren(): bool
    {
        if (!$this->valid()) {
            return false;
        }

        return $this->current() instanceof NestedValidationException;
    }

    public function getChildren(): self
    {
        $exception = $this->current();
        if (!$exception instanceof NestedValidationException) {
            throw new UnexpectedValueException();
        }

        return new static($exception);
    }

    /**
     * @return ValidationException|NestedValidationException
     */
    public function current(): ValidationException
    {
        return $this->exceptions->current();
    }

    public function key(): int
    {
        return (int) $this->exceptions->key();
    }

    public function next(): void
    {
        $this->exceptions->next();
    }

    public function rewind(): void
    {
        $this->exceptions->rewind();
    }

    public function valid(): bool
    {
        return $this->exceptions->valid();
    }
}
