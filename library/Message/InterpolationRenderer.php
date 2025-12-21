<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use ReflectionClass;
use Respect\Stringifier\Stringifier;
use Respect\Validation\Message\Placeholder\Listed;
use Respect\Validation\Message\Placeholder\Quoted;
use Respect\Validation\Name;
use Respect\Validation\Result;
use Respect\Validation\Rule;

use function array_key_exists;
use function is_array;
use function is_bool;
use function is_scalar;
use function is_string;
use function preg_replace_callback;
use function print_r;

final class InterpolationRenderer implements Renderer
{
    /** @var array<string, array<Template>> */
    private array $templates = [];

    public function __construct(
        private readonly Translator $translator,
        private readonly Stringifier $stringifier = new ValidationStringifier(),
    ) {
    }

    public function render(Result $result): string
    {
        $parameters = ['path' => $result->path, 'input' => $result->input, 'name' => $this->getName($result)];
        $parameters += $result->parameters;

        $rendered = (string) preg_replace_callback(
            '/{{(\w+)(\|([^}]+))?}}/',
            function (array $matches) use ($parameters) {
                if (!isset($parameters[$matches[1]])) {
                    return $matches[0];
                }

                return $this->placeholder($matches[1], $parameters[$matches[1]], $matches[3] ?? null);
            },
            $this->translator->translate($this->getTemplateMessage($result)),
        );

        if (!$result->hasCustomTemplate() && $result->adjacent !== null) {
            $rendered .= ' ' . $this->render($result->adjacent);
        }

        return $rendered;
    }

    /** @return array<Template> */
    private function extractTemplates(Rule $rule): array
    {
        if (!isset($this->templates[$rule::class])) {
            $reflection = new ReflectionClass($rule);
            foreach ($reflection->getAttributes(Template::class) as $attribute) {
                $this->templates[$rule::class][] = $attribute->newInstance();
            }
        }

        return $this->templates[$rule::class] ?? [];
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

    private function getTemplateMessage(Result $result): string
    {
        if ($result->hasCustomTemplate()) {
            return $result->template;
        }

        foreach ($this->extractTemplates($result->rule) as $template) {
            if ($template->id !== $result->template) {
                continue;
            }

            if ($result->hasInvertedMode) {
                return $template->inverted;
            }

            return $template->default;
        }

        return $result->template;
    }

    private function getName(Result $result): Name
    {
        if (array_key_exists('name', $result->parameters) && is_string($result->parameters['name'])) {
            return new Name($result->parameters['name']);
        }

        if (array_key_exists('name', $result->parameters)) {
            return new Name((string) $this->stringifier->stringify($result->parameters['name'], 0));
        }

        if ($result->name !== null) {
            return $result->path ? $result->name->withPath($result->path) : $result->name;
        }

        if ($result->path?->value !== null) {
            return new Name((string) $this->stringifier->stringify($result->path, 0));
        }

        return new Name((string) $this->stringifier->stringify($result->input, 0));
    }
}
