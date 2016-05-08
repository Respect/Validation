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

use Countable;
use Iterator;

class ResultIterator implements Countable, Iterator
{
    /**
     * @var Result[]
     */
    private $children;

    /**
     * Initializes the object.
     *
     * @param Result $result
     */
    public function __construct(Result $result)
    {
        $this->children = $result->getChildren();
    }

    public function current(): ?Result
    {
        $current = current($this->children);
        if (false === $current) {
            return null;
        }

        return $current;
    }

    public function next(): ?Result
    {
        $next = next($this->children);
        if (false == $next) {
            return null;
        }

        return $next;
    }

    public function key()
    {
        $current = $this->current();
        if (null === $current) {
            return null;
        }

        return $current->getProperties()['reference'] ?? key($this->children);
    }

    public function valid(): bool
    {
        return null !== $this->current();
    }

    public function rewind(): void
    {
        reset($this->children);
    }

    public function count(): int
    {
        return count($this->children);
    }
}
