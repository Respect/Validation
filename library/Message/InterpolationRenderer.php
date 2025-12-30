<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use Respect\Validation\Message\Formatter\TemplateResolver;
use Respect\Validation\Message\Placeholder\Subject;
use Respect\Validation\Result;

use function array_key_exists;
use function array_pad;
use function assert;
use function is_string;
use function preg_replace_callback;

final readonly class InterpolationRenderer implements Renderer
{
    public function __construct(
        private Translator $translator,
        private Modifier $modifier,
        private TemplateResolver $templateResolver = new TemplateResolver(),
    ) {
    }

    /** @param array<string|int, mixed> $templates */
    public function render(Result $result, array $templates): string
    {
        $parameters = ['path' => $result->path, 'input' => $result->input, 'subject' => Subject::fromResult($result)];
        $parameters += $result->parameters;

        $givenTemplate = $this->templateResolver->getGivenTemplate($result, $templates);
        $ruleTemplate = $this->templateResolver->getRuleTemplate($result);

        $rendered = (string) preg_replace_callback(
            '/{{(\w+)(\|([^}]+))?}}/',
            fn(array $matches) => $this->processPlaceholder($parameters, $matches),
            $this->translator->translate($givenTemplate ?? $ruleTemplate),
        );

        if (!$result->hasCustomTemplate() && $givenTemplate === null && $result->adjacent !== null) {
            $rendered .= ' ' . $this->render($result->adjacent, $templates);
        }

        return $rendered;
    }

    /**
     * @param array<string, mixed>    $parameters
     * @param array<int, string|null> $matches
     */
    private function processPlaceholder(array $parameters, array $matches): string
    {
        [$placeholder, $name, , $pipe] = array_pad($matches, 4, null);
        assert(is_string($placeholder));
        assert(is_string($name));
        if (!array_key_exists($name, $parameters)) {
            return $placeholder;
        }

        return $this->modifier->modify($parameters[$name], $pipe);
    }
}
