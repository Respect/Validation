<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Result;

use function array_filter;
use function count;
use function is_array;
use function is_string;
use function Respect\Stringifier\stringify;
use function sprintf;

final readonly class TemplateResolver
{
    /** @param array<string|int, mixed> $templates */
    public function resolve(Result $result, array $templates): Result
    {
        if ($result->hasCustomTemplate()) {
            return $result;
        }

        foreach ([...$this->getKeys($result), '__root__'] as $key) {
            if (!isset($templates[$key])) {
                continue;
            }

            if (is_string($templates[$key])) {
                return $result->withTemplate($templates[$key]);
            }

            throw new ComponentException(
                sprintf('Template for "%s" must be a string, %s given', $key, stringify($templates[$key])),
            );
        }

        return $result;
    }

    /** @param array<string|int, mixed> $templates */
    public function hasMatch(Result $result, array $templates): bool
    {
        foreach ($this->getKeys($result) as $key) {
            if (isset($templates[$key]) && is_string($templates[$key])) {
                return true;
            }
        }

        if (count($templates) !== 1) {
            return false;
        }

        return isset($templates['__root__']) && is_string($templates['__root__']);
    }

    /**
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    public function selectMatches(Result $result, array $templates): array
    {
        foreach ($this->getKeys($result) as $key) {
            if ($key !== null && isset($templates[$key]) && is_array($templates[$key])) {
                return $templates[$key];
            }
        }

        return $templates;
    }

    /** @return non-empty-array<string|int> */
    private function getKeys(Result $result): array
    {
        return array_filter([$result->path, $result->name, $result->id], static fn($key) => $key !== null);
    }
}
