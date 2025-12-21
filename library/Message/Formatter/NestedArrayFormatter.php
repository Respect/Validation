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
    public function __construct(
        private TemplateResolver $templateResolver,
    ) {
    }

    /**
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    public function format(Result $result, Renderer $renderer, array $templates): array
    {
        $matchedTemplates = $this->templateResolver->selectMatches($result, $templates);
        if (count($result->children) === 0 || $this->templateResolver->hasMatch($result, $matchedTemplates)) {
            return [
                $result->path->value ?? $result->id->value => $renderer->render(
                    $this->templateResolver->resolve($result->withoutParentPath(), $matchedTemplates),
                ),
            ];
        }

        $messages = [];
        foreach ($result->children as $child) {
            $key = $child->path->value ?? $child->id->value;
            $messages[$key] = $this->format(
                $child->withoutParentPath()->withoutName(),
                $renderer,
                $this->templateResolver->selectMatches($child, $matchedTemplates),
            );
            if (count($messages[$key]) !== 1) {
                continue;
            }

            $messages[$key] = current($messages[$key]);
        }

        if (count($messages) > 1) {
            $self = [
                '__root__' => $renderer->render(
                    $this->templateResolver->resolve($result->withoutParentPath(), $matchedTemplates),
                ),
            ];

            return $self + $messages;
        }

        return $messages;
    }
}
