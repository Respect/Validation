<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use ReflectionClass;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Message\Parameter\Processor;
use Respect\Validation\Mode;
use Respect\Validation\Result;
use Respect\Validation\Validatable;
use Throwable;

use function call_user_func;
use function preg_replace_callback;
use function sprintf;

final class StandardRenderer implements Renderer
{
    /** @var array<string, array<Template>> */
    private array $templates = [];

    /** @var callable */
    private $translator;

    public function __construct(
        callable $translator,
        private readonly Processor $processor
    ) {
        $this->translator = $translator;
    }

    public function render(Result $result, ?string $template = null): string
    {
        $parameters = $result->parameters;
        $parameters['name'] ??= $result->name ?? $this->processor->process('input', $result->input);
        $parameters['input'] = $result->input;

        $rendered = (string) preg_replace_callback(
            '/{{(\w+)(\|([^}]+))?}}/',
            function (array $matches) use ($parameters) {
                if (!isset($parameters[$matches[1]])) {
                    return $matches[0];
                }

                return $this->processor->process($matches[1], $parameters[$matches[1]], $matches[3] ?? null);
            },
            $this->translate($template ?? $this->getTemplateMessage($result))
        );

        if (!$result->hasCustomTemplate() && $result->nextSibling !== null) {
            $rendered .= ' ' . $this->render($result->nextSibling);
        }

        return $rendered;
    }

    private function translate(string $message): string
    {
        try {
            return call_user_func($this->translator, $message);
        } catch (Throwable $throwable) {
            throw new ComponentException(sprintf('Failed to translate "%s"', $message), 0, $throwable);
        }
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

    private function getTemplateMessage(Result $result): string
    {
        if ($result->hasCustomTemplate()) {
            return $result->template;
        }

        foreach ($this->extractTemplates($result->rule) as $template) {
            if ($template->id !== $result->template) {
                continue;
            }

            if ($result->mode == Mode::NEGATIVE) {
                return $template->negative;
            }

            return $template->default;
        }

        return $result->template;
    }
}
