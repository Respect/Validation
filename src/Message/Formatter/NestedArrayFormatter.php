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

use function array_reduce;
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
            return [$this->getKey($result) => $renderer->render($result, $templates)];
        }

        [$children, $hasString] = $this->prepareChildren($result->children);

        $messages = array_reduce(
            $children,
            fn(array $messages, array $item) => $this->appendMessage(
                $messages,
                $item['key'],
                $item['child'],
                $renderer,
                $templates,
                $hasString,
            ),
            [],
        );

        if (count($messages) > 1) {
            return ['__root__' => $renderer->render($result, $templates)] + $messages;
        }

        return $messages;
    }

    /**
     * @param array<Result> $children
     *
     * @return array{0: array<array{key: string|int, child: Result}>, 1: bool}
     */
    private function prepareChildren(array $children): array
    {
        $mapped = [];
        $hasString = false;

        foreach ($children as $child) {
            $key = $this->getKey($child);
            if (!is_numeric($key)) {
                $hasString = true;
            }

            $mapped[] = ['key' => $key, 'child' => $child];
        }

        return [$mapped, $hasString];
    }

    /**
     * @param array<string|int, mixed> $messages
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    private function appendMessage(
        array $messages,
        string|int $key,
        Result $child,
        Renderer $renderer,
        array $templates,
        bool $hasString,
    ): array {
        if ($hasString && is_numeric($key)) {
            $key = $child->id->value;
        }

        $message = $this->renderChild($child, $renderer, $templates);

        if (!$hasString) {
            $messages[] = $message;

            return $messages;
        }

        if (isset($messages[$key])) {
            if (!is_array($messages[$key])) {
                $messages[$key] = [$messages[$key]];
            }

            $messages[$key][] = $message;

            return $messages;
        }

        $messages[$key] = $message;

        return $messages;
    }

    /**
     * @param array<string|int, array<string>> $templates
     *
     * @return array<string>|string
     */
    private function renderChild(Result $child, Renderer $renderer, array $templates): array|string
    {
        $formatted = $this->format(
            $child->withoutName(),
            $renderer,
            $templates,
        );

        if (count($formatted) === 1) {
            return current($formatted);
        }

        return $formatted;
    }

    private function getKey(Result $result): string|int
    {
        return $result->path->value ?? $result->id->value;
    }
}
