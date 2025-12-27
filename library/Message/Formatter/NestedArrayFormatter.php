<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use Respect\Validation\Message\ArrayFormatter;
use Respect\Validation\Message\Renderer;
use Respect\Validation\Result;

use function count;
use function current;

final readonly class NestedArrayFormatter implements ArrayFormatter
{
    /**
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    public function format(Result $result, Renderer $renderer, array $templates): array
    {
        if (count($result->children) === 0) {
            return [
                $result->subject->path->value ?? $result->id->value => $renderer->render($result, $templates),
            ];
        }

        $messages = [];
        foreach ($result->children as $child) {
            $key = $child->subject->path->value ?? $child->id->value;
            $messages[$key] = $this->format(
                $child->withoutName(),
                $renderer,
                $templates,
            );
            if (count($messages[$key]) !== 1) {
                continue;
            }

            $messages[$key] = current($messages[$key]);
        }

        if (count($messages) > 1) {
            return ['__root__' => $renderer->render($result, $templates)] + $messages;
        }

        return $messages;
    }
}
