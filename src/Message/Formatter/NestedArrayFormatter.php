<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use Respect\Validation\Message\ArrayFormatter;
use Respect\Validation\Message\Renderer;
use Respect\Validation\Result;

use function array_values;
use function count;
use function current;
use function is_array;
use function is_numeric;

final readonly class NestedArrayFormatter implements ArrayFormatter
{
    /**
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    public function format(Result $result, Renderer $renderer, array $templates): array
    {
        if ($result->children === []) {
            return [$result->path->value ?? $result->id->value => $renderer->render($result, $templates)];
        }

        $hasStringKey = false;
        foreach ($result->children as $child) {
            if (!is_numeric($child->path->value ?? $child->id->value)) {
                $hasStringKey = true;
                break;
            }
        }

        $messages = [];
        $childCount = count($result->children);
        foreach ($result->children as $child) {
            $messages = $this->formatChild(
                $messages,
                $child,
                $renderer,
                $templates,
                $hasStringKey,
                $result,
                $childCount > 1,
            );
        }

        if (count($messages) > 1) {
            return ['__root__' => $renderer->render($result, $templates)] + $messages;
        }

        return $messages;
    }

    /**
     * @param array<string|int, mixed> $messages
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    private function formatChild(
        array $messages,
        Result $child,
        Renderer $renderer,
        array $templates,
        bool $hasStringKey,
        Result $parent,
        bool $hasMultipleChildren,
    ): array {
        $rawKey = $child->path->value ?? $child->id->value;
        $normalizedKey = $hasStringKey && is_numeric($rawKey) ? $child->id->value : $rawKey;

        $formatted = $this->format(
            $hasMultipleChildren && $child->name === $parent->name ? $child->withoutName() : $child,
            $renderer,
            $templates,
        );

        $childMessage = count($formatted) === 1 ? current($formatted) : $formatted;

        if (is_array($childMessage) && count($childMessage) > 1 && !isset($childMessage['__root__'])) {
            $childMessage = ['__root__' => $renderer->render($child, $templates)] + $childMessage;
        }

        if (!$hasStringKey) {
            $messages[] = $childMessage;

            return $messages;
        }

        if (!isset($messages[$normalizedKey])) {
            $messages[$normalizedKey] = $childMessage;

            return $messages;
        }

        if ($child->path !== null) {
            return $this->mergeWithExistingPath($messages, $normalizedKey, $childMessage);
        }

        return $this->flattenToIndexedList($messages, $childMessage, $parent, $renderer, $templates);
    }

    /**
     * @param array<string|int, mixed> $messages
     * @param array<string|int, mixed>|string $childMessage
     *
     * @return array<string|int, mixed>
     */
    private function mergeWithExistingPath(array $messages, string|int $key, array|string $childMessage): array
    {
        if (is_array($messages[$key])) {
            if (isset($messages[$key]['__root__'])) {
                $messages[$key] = [$messages[$key]];
            }

            $messages[$key][] = $childMessage;
        } else {
            $messages[$key] = [$messages[$key], $childMessage];
        }

        return $messages;
    }

    /**
     * @param array<string|int, mixed> $messages
     * @param array<string|int, mixed>|string $childMessage
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    private function flattenToIndexedList(
        array $messages,
        array|string $childMessage,
        Result $parent,
        Renderer $renderer,
        array $templates,
    ): array {
        $parentMessage = $messages['__root__'] ?? $renderer->render($parent, $templates);

        return ['__root__' => $parentMessage] + array_values($messages) + [count($messages) => $childMessage];
    }
}
