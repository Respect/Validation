<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use Respect\Validation\Message\ArrayFormatter;
use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\Translator;
use Respect\Validation\Result;

use function count;
use function current;

final readonly class NestedArrayFormatter implements ArrayFormatter
{
    use PathProcessor;

    public function __construct(
        private Renderer $renderer,
        private TemplateResolver $templateResolver,
    ) {
    }

    /**
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    public function format(Result $result, array $templates, Translator $translator): array
    {
        $matchedTemplates = $this->templateResolver->selectMatches($result, $templates);
        if (count($result->children) === 0 || $this->templateResolver->hasMatch($result, $matchedTemplates)) {
            return [
                $result->getDeepestPath() ?? $result->id => $this->renderer->render(
                    $this->templateResolver->resolve($result->withDeepestPath(), $matchedTemplates),
                    $translator,
                ),
            ];
        }

        $messages = [];
        foreach ($result->children as $child) {
            $key = $child->getDeepestPath() ?? $child->id ?? 0;
            $messages[$key] = $this->format(
                $this->overwritePath($result, $child),
                $this->templateResolver->selectMatches($child, $matchedTemplates),
                $translator,
            );
            if (count($messages[$key]) !== 1) {
                continue;
            }

            $messages[$key] = current($messages[$key]);
        }

        if (count($messages) > 1) {
            $self = [
                '__root__' => $this->renderer->render(
                    $this->templateResolver->resolve($result->withDeepestPath(), $matchedTemplates),
                    $translator,
                ),
            ];

            return $self + $messages;
        }

        return $messages;
    }
}
