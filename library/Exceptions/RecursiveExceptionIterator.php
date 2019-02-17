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

use ArrayIterator;
use Countable;
use RecursiveIterator;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class RecursiveExceptionIterator implements RecursiveIterator, Countable
{
    /**
     * @var ArrayIterator|ValidationException[]
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
        return new static($this->current());
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
        return $this->exceptions->key();
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
