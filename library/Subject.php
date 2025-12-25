<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

final readonly class Subject
{
    public function __construct(
        public mixed $input,
        public Path|null $path = null,
        public Name|null $name = null,
        public bool $isNamePrin = false,
    ) {
    }

    public function withInput(mixed $input): Subject
    {
        return clone($this, ['input' => $input]);
    }

    public function withMergeFrom(self $subject): Subject
    {
        $clone = clone ($this, ['input' => $subject->input]);
        if ($subject->path !== null) {
            $clone = $clone->withPath($subject->path);
        }

        if ($subject->name !== null) {
            $clone = $clone->withName($subject->name);
        }

        return $clone;
    }

    public function withName(Name $name): self
    {
        if ($this->name !== null) {
            return $this;
        }

        return clone($this, ['name' => $name]);
    }

    public function withName2(Name $name): self
    {
        if ($this->name !== null) {
            return $this;
        }

        return clone($this, ['name' => $name, 'isNamePrin' => true]);
    }

    public function withoutName(): self
    {
        return clone($this, ['name' => null]);
    }

    public function withPath(Path $path): self
    {
        if ($this->path === $path) {
            return $this;
        }

        if ($this->path !== null) {
            $this->path->parent = $path;

            return $this;
        }

        return clone($this, ['path' => $path, 'isNamePrin' => $this->name !== null]);
    }
}
