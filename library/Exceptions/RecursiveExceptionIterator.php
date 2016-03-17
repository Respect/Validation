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

use Countable;
use RecursiveIterator;

class RecursiveExceptionIterator implements RecursiveIterator, Countable
{
    private $exceptions;

    public function __construct(NestedValidationException $parent)
    {
        $this->exceptions = $parent->getRelated();
    }

    public function count()
    {
        return $this->exceptions->count();
    }

    public function hasChildren()
    {
        if (!$this->valid()) {
            return false;
        }

        return ($this->current() instanceof NestedValidationException);
    }

    public function getChildren()
    {
        return new static($this->current());
    }

    public function current()
    {
        return $this->exceptions->current();
    }

    public function key()
    {
        return $this->exceptions->key();
    }

    public function next()
    {
        $this->exceptions->next();
    }

    public function rewind()
    {
        $this->exceptions->rewind();
    }

    public function valid()
    {
        return $this->exceptions->valid();
    }
}
