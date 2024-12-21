<?php

declare(strict_types=1);

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

namespace Respect\Validation;

use Countable;
use Iterator;
use RecursiveIterator;

use function array_filter;
use function array_key_exists;
use function array_map;
use function array_values;
use function count;
use function current;
use function key;
use function next;
use function reset;

/**
 * @implements Iterator<int, Result>
 * @implements RecursiveIterator<int, Result>
 */
final class FailedResultIterator implements Iterator, Countable, RecursiveIterator
{
    /**
     * @var array<int, Result>
     */
    private array $children;

    public function __construct(
        private readonly Result $result,
    ) {
        $this->children = $this->extractDeduplicatedChildren();
    }

    public function current(): Result|false
    {
        return current($this->children);
    }

    /**
     * @return array<int, Result>
     */
    public function getArrayCopy(): array
    {
        return $this->children;
    }

    public function next(): void
    {
        next($this->children);
    }

    public function key(): ?int
    {
        return key($this->children);
    }

    public function valid(): bool
    {
        return key($this->children) !== null;
    }

    public function rewind(): void
    {
        reset($this->children);
    }

    public function count(): int
    {
        return count($this->children);
    }

    public function hasChildren(): bool
    {
        return $this->result->children !== [];
    }

    /**
     * @return null|RecursiveIterator<int, Result>
     */
    public function getChildren(): ?RecursiveIterator
    {
        if (!$this->hasChildren()) {
            return null;
        }

        return new self($this->result);
    }

    /**
     * @return array<int, Result>
     */
    private function extractDeduplicatedChildren(): array
    {
        /** @var array<string, Result> $deduplicatedResults */
        $deduplicatedResults = [];
        $duplicateCounters = [];
        foreach ($this->result->children as $child) {
            if ($child->path !== null) {
                $deduplicatedResults[$child->path] = $child->hasPassed ? null : $child;
                continue;
            }

            $id = $child->id;
            if (isset($duplicateCounters[$id])) {
                $id .= '.' . ++$duplicateCounters[$id];
            } elseif (array_key_exists($id, $deduplicatedResults)) {
                $deduplicatedResults[$id . '.1'] = $deduplicatedResults[$id]?->withId($id . '.1');
                unset($deduplicatedResults[$id]);
                $duplicateCounters[$id] = 2;
                $id .= '.2';
            }

            $deduplicatedResults[$id] = $child->hasPassed ? null : $child->withId($id);
        }

        return array_map(
            function (Result $child): Result {
                if ($this->result->path !== null && $child->path !== null && $child->path !== $this->result->path) {
                    return $child->withPath($this->result->path);
                }

                if ($this->result->path !== null && $child->path === null) {
                    return $child->withPath($this->result->path);
                }

                return $child;
            },
            array_values(array_filter($deduplicatedResults))
        );
    }
}
