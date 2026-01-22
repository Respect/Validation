<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use ReflectionClass;
use Respect\Validation\Message\Template;
use Respect\Validation\Path;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function array_reduce;
use function array_reverse;
use function is_array;
use function is_string;

final class TemplateResolver
{
    /** @var array<string, array<Template>> */
    private array $templates = [];

    /** @param array<string|int, mixed> $templates */
    public function getGivenTemplate(Result $result, array $templates): string|null
    {
        if ($result->hasCustomTemplate()) {
            return $result->template;
        }

        if ($result->path !== null) {
            $templates = $this->filterByPath($result->path, $templates);
        }

        foreach ([$result->path?->value, $result->name?->value, $result->id->value, '__root__'] as $key) {
            if ($key === null || !isset($templates[$key])) {
                continue;
            }

            if (is_string($templates[$key])) {
                return $templates[$key];
            }
        }

        return null;
    }

    public function getValidatorTemplate(Result $result): string
    {
        foreach ($this->extractTemplates($result->validator) as $template) {
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

    /** @return array<Template> */
    private function extractTemplates(Validator $validator): array
    {
        if (!isset($this->templates[$validator::class])) {
            $reflection = new ReflectionClass($validator);
            foreach ($reflection->getAttributes(Template::class) as $attribute) {
                $this->templates[$validator::class][] = $attribute->newInstance();
            }
        }

        return $this->templates[$validator::class] ?? [];
    }

    /**
     * @param array<string|int> $nodes
     *
     * @return non-empty-array<string|int>
     */
    private function getNodes(Path $path, array $nodes = []): array
    {
        $nodes[] = $path->value;
        if ($path->parent !== null) {
            return $this->getNodes($path->parent, $nodes);
        }

        return $nodes;
    }

    /**
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    private function filterByPath(Path $path, array $templates): array
    {
        return array_reduce(
            array_reverse($this->getNodes($path)),
            static fn(array $carry, $node) => isset($carry[$node]) && is_array($carry[$node]) ? $carry[$node] : $carry,
            $templates,
        );
    }
}
