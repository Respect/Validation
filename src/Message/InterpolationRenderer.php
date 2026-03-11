<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use Respect\StringFormatter\PlaceholderFormatter;
use Respect\Validation\Message\Formatter\TemplateResolver;
use Respect\Validation\Result;
use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class InterpolationRenderer implements Renderer
{
    public function __construct(
        private TranslatorInterface $translator,
        private PlaceholderFormatter $formatter,
        private TemplateResolver $templateResolver,
    ) {
    }

    /** @param array<string|int, mixed> $templates */
    public function render(Result $result, array $templates, bool $isRoot = true): string
    {
        $parameters = ['path' => $result->path, 'input' => $result->input, 'subject' => $result];
        $parameters += $result->parameters;

        $givenTemplate = $this->templateResolver->getGivenTemplate($result, $templates, $isRoot);

        $rendered = $this->formatter->formatUsing(
            $this->translator->trans($givenTemplate ?? $this->templateResolver->getValidatorTemplate($result)),
            $parameters,
        );

        if (!$result->hasCustomTemplate() && $givenTemplate === null && $result->adjacent !== null) {
            $rendered .= ' ' . $this->render($result->adjacent, $templates, false);
        }

        return $rendered;
    }
}
