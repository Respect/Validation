<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

use function array_filter;
use function array_intersect;
use function array_map;

/** @implements IteratorAggregate<array<array{mixed}>> */
final class DataProvider implements IteratorAggregate
{
    /** @param array<mixed> $data */
    public function __construct(
        private readonly array $data,
    ) {
    }

    public function with(string ...$tags): self
    {
        return new self(array_filter(
            $this->data,
            static fn($value) => array_intersect($tags, $value['tags']) === $tags,
        ));
    }

    public function withAny(string ...$tags): self
    {
        return new self(array_filter(
            $this->data,
            static fn($value) => array_intersect($tags, $value['tags']) !== [],
        ));
    }

    public function without(string ...$tags): self
    {
        return new self(array_filter(
            $this->data,
            static fn($value) => array_intersect($tags, $value['tags']) === [],
        ));
    }

    /** @return Traversable<array<mixed>> */
    public function getIterator(): Traversable
    {
        return new ArrayIterator(array_map(static fn(array $value) => $value['value'], $this->data));
    }
}
