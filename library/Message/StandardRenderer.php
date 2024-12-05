<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use ReflectionClass;
use Respect\Stringifier\Stringifier;
use Respect\Stringifier\Stringifiers\CompositeStringifier;
use Respect\Validation\Mode;
use Respect\Validation\Result;
use Respect\Validation\Validatable;

use function is_bool;
use function is_scalar;
use function is_string;
use function preg_replace_callback;
use function print_r;

final class StandardRenderer implements Renderer
{
    /** @var array<string, array<Template>> */
    private array $templates = [];

    private readonly Stringifier $stringifier;

    public function __construct(?Stringifier $stringifier = null)
    {
        $this->stringifier = $stringifier ?? CompositeStringifier::createDefault();
    }

    public function render(Result $result, Translator $translator, ?string $template = null): string
    {
        $parameters = $result->parameters;
        $parameters['name'] ??= $result->name ?? $this->placeholder('input', $result->input, $translator);
        $parameters['input'] = $result->input;

        $rendered = (string) preg_replace_callback(
            '/{{(\w+)(\|([^}]+))?}}/',
            function (array $matches) use ($parameters, $translator) {
                if (!isset($parameters[$matches[1]])) {
                    return $matches[0];
                }

                return $this->placeholder($matches[1], $parameters[$matches[1]], $translator, $matches[3] ?? null);
            },
            $translator->translate($template ?? $this->getTemplateMessage($result))
        );

        if (!$result->hasCustomTemplate() && $result->nextSibling !== null) {
            $rendered .= ' ' . $this->render($result->nextSibling, $translator);
        }

        return $rendered;
    }

    /** @return array<Template> */
    private function extractTemplates(Validatable $rule): array
    {
        if (!isset($this->templates[$rule::class])) {
            $reflection = new ReflectionClass($rule);
            foreach ($reflection->getAttributes(Template::class) as $attribute) {
                $this->templates[$rule::class][] = $attribute->newInstance();
            }
        }

        return $this->templates[$rule::class] ?? [];
    }

    private function placeholder(string $name, mixed $value, Translator $translator, ?string $modifier = null): string
    {
        if ($modifier === 'raw' && is_scalar($value)) {
            return is_bool($value) ? (string) (int) $value : (string) $value;
        }

        if ($modifier === 'trans' && is_string($value)) {
            return $translator->translate($value);
        }

        if ($name === 'name' && is_string($value)) {
            return $value;
        }

        return $this->stringifier->stringify($value, 0) ?? print_r($value, true);
    }

    private function getTemplateMessage(Result $result): string
    {
        if ($result->hasCustomTemplate()) {
            return $result->template;
        }

        foreach ($this->extractTemplates($result->rule) as $template) {
            if ($template->id !== $result->template) {
                continue;
            }

            if ($result->mode == Mode::INVERTED) {
                return $template->inverted;
            }

            return $template->default;
        }

        return $result->template;
    }
}
