<?php

declare(strict_types=1);

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

namespace Respect\Validation;

use Respect\Validation\Message\ArrayFormatter;
use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\StringFormatter;
use Stringable;

use function array_shift;
use function explode;
use function implode;
use function is_string;

final readonly class ResultQuery implements Stringable
{
    /** @param array<string|int, mixed> $templates */
    public function __construct(
        private Result $result,
        private Renderer $renderer,
        private StringFormatter $messageFormatter,
        private StringFormatter $fullMessageFormatter,
        private ArrayFormatter $messagesFormatter,
        private array $templates,
    ) {
    }

    public function findById(string $id): self|null
    {
        if ($this->result->id->value === $id) {
            return $this;
        }

        foreach ($this->result->children as $child) {
            $resultQuery = clone ($this, ['result' => $child]);
            if ($child->id->value === $id) {
                return $resultQuery;
            }

            return $resultQuery->findById($id);
        }

        return null;
    }

    public function findByName(string $name): self|null
    {
        if ($this->result->subject->name?->value === $name) {
            return $this;
        }

        foreach ($this->result->children as $child) {
            $resultQuery = clone ($this, ['result' => $child]);
            if ($child->subject->name?->value === $name) {
                return $resultQuery;
            }

            return $resultQuery->findByName($name);
        }

        return null;
    }

    public function findByPath(string|int $path): self|null
    {
        if ($this->result->subject->path?->value === $path) {
            return $this;
        }

        $paths = is_string($path) ? explode('.', $path) : [$path];
        $currentPath = array_shift($paths);

        foreach ($this->result->children as $child) {
            if ($child->subject->path?->value !== $currentPath) {
                continue;
            }

            $resultQuery = clone ($this, ['result' => $child]);
            if ($paths === []) {
                return $resultQuery;
            }

            return $resultQuery->findByPath(is_string($path) ? implode('.', $paths) : $path);
        }

        return null;
    }

    public function isValid(): bool
    {
        return $this->result->hasPassed;
    }

    public function toMessage(): string
    {
        if ($this->result->hasPassed) {
            return '';
        }

        return $this->messageFormatter->format($this->result, $this->renderer, $this->templates);
    }

    public function toFullMessage(): string
    {
        if ($this->result->hasPassed) {
            return '';
        }

        return $this->fullMessageFormatter->format($this->result, $this->renderer, $this->templates);
    }

    /** @return array<string|int, mixed> */
    public function toArrayMessages(): array
    {
        if ($this->result->hasPassed) {
            return [];
        }

        return $this->messagesFormatter->format($this->result, $this->renderer, $this->templates);
    }

    public function __toString(): string
    {
        return $this->toMessage();
    }
}
