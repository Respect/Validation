<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use Respect\Stringifier\Stringifier;
use Respect\Validation\Message\Formatter\TemplateResolver;
use Respect\Validation\Message\Placeholder\Listed;
use Respect\Validation\Message\Placeholder\Quoted;
use Respect\Validation\Name;
use Respect\Validation\Result;

use function array_key_exists;
use function is_array;
use function is_bool;
use function is_scalar;
use function is_string;
use function preg_replace_callback;
use function print_r;

final readonly class InterpolationRenderer implements Renderer
{
    public function __construct(
        private Translator $translator,
        private Stringifier $stringifier = new ValidationStringifier(),
        private TemplateResolver $templateResolver = new TemplateResolver(),
    ) {
    }

    /** @param array<string|int, mixed> $templates */
    public function render(Result $result, array $templates): string
    {
        $parameters = ['path' => $result->path, 'input' => $result->input, 'subject' => $this->getName($result)];
        $parameters += $result->parameters;

        $givenTemplate = $this->templateResolver->getGivenTemplate($result, $templates);
        $ruleTemplate = $this->templateResolver->getRuleTemplate($result);

        $rendered = (string) preg_replace_callback(
            '/{{(\w+)(\|([^}]+))?}}/',
            function (array $matches) use ($parameters) {
                if (!array_key_exists($matches[1], $parameters)) {
                    return $matches[0];
                }

                return $this->placeholder($matches[1], $parameters[$matches[1]], $matches[3] ?? null);
            },
            $this->translator->translate($givenTemplate ?? $ruleTemplate),
        );

        if (!$result->hasCustomTemplate() && $givenTemplate === null && $result->adjacent !== null) {
            $rendered .= ' ' . $this->render($result->adjacent, $templates);
        }

        return $rendered;
    }

    private function placeholder(
        string $name,
        mixed $value,
        string|null $modifier = null,
    ): string {
        if ($modifier === 'quote' && is_string($value)) {
            return $this->placeholder($name, new Quoted($value));
        }

        if ($modifier === 'listOr' && is_array($value)) {
            return $this->placeholder($name, new Listed($value, $this->translator->translate('or')));
        }

        if ($modifier === 'listAnd' && is_array($value)) {
            return $this->placeholder($name, new Listed($value, $this->translator->translate('and')));
        }

        if ($modifier === 'raw' && is_scalar($value)) {
            return is_bool($value) ? (string) (int) $value : (string) $value;
        }

        if ($modifier === 'trans' && is_string($value)) {
            return $this->translator->translate($value);
        }

        return $this->stringifier->stringify($value, 0) ?? print_r($value, true);
    }

    private function getName(Result $result): mixed
    {
        if (array_key_exists('name', $result->parameters) && is_string($result->parameters['name'])) {
            return new Name($result->parameters['name']);
        }

        if (array_key_exists('name', $result->parameters)) {
            return $result->parameters['name'];
        }

        if ($result->name !== null) {
            return $result->name;
        }

        if ($result->path?->value !== null) {
            return $result->path;
        }

        return $result->input;
    }
}
