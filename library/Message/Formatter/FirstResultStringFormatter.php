<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\StringFormatter;
use Respect\Validation\Message\Translator;
use Respect\Validation\Result;

final readonly class FirstResultStringFormatter implements StringFormatter
{
    public function __construct(
        private Renderer $renderer,
        private TemplateResolver $templateResolver,
    ) {
    }

    /** @param array<string|int, mixed> $templates */
    public function format(Result $result, array $templates, Translator $translator): string
    {
        $matchedTemplates = $this->templateResolver->selectMatches($result, $templates);
        if (!$this->templateResolver->hasMatch($result, $matchedTemplates)) {
            foreach ($result->children as $child) {
                return $this->format(
                    $child,
                    $matchedTemplates,
                    $translator,
                );
            }
        }

        return $this->renderer->render($this->templateResolver->resolve($result, $matchedTemplates), $translator);
    }
}
