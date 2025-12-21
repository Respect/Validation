<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\StringFormatter;
use Respect\Validation\Result;

final readonly class FirstResultStringFormatter implements StringFormatter
{
    public function __construct(
        private TemplateResolver $templateResolver,
    ) {
    }

    /** @param array<string|int, mixed> $templates */
    public function format(Result $result, Renderer $renderer, array $templates): string
    {
        $matchedTemplates = $this->templateResolver->selectMatches($result, $templates);
        if (!$this->templateResolver->hasMatch($result, $matchedTemplates)) {
            foreach ($result->children as $child) {
                return $this->format($child, $renderer, $matchedTemplates);
            }
        }

        return $renderer->render($this->templateResolver->resolve($result, $matchedTemplates));
    }
}
