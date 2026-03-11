<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use Respect\Validation\Message\TemplateRegistry;
use Respect\Validation\Path;
use Respect\Validation\Result;

use function is_array;
use function is_string;

final class TemplateResolver
{
    public function __construct(
        private TemplateRegistry $templateRegistry,
    ) {
    }

    /** @param array<string|int, mixed> $templates */
    public function getGivenTemplate(Result $result, array $templates, bool $isRoot = true): string|null
    {
        if ($result->hasCustomTemplate()) {
            return $result->template;
        }

        $filtered = $templates;
        $isAtCorrectScope = $isRoot;

        if ($result->path !== null) {
            [$filtered, $isAtCorrectScope] = $this->filterByPath($result->path, $templates);
        }

        foreach ([$result->path?->value, $result->name?->value, $result->id->value] as $key) {
            if ($key === null || !isset($filtered[$key])) {
                continue;
            }

            if (is_string($filtered[$key])) {
                return $filtered[$key];
            }
        }

        if ($isAtCorrectScope && isset($filtered['__root__']) && is_string($filtered['__root__'])) {
            return $filtered['__root__'];
        }

        return null;
    }

    public function getValidatorTemplate(Result $result): string
    {
        foreach ($this->templateRegistry->getTemplates($result->validator::class) as $template) {
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

    /**
     * @param array<string|int, mixed> $templates
     *
     * @return array{array<string|int, mixed>, bool}
     */
    private function filterByPath(Path $path, array $templates): array
    {
        if ($path->parent !== null) {
            [$templates, $fullyConsumed] = $this->filterByPath($path->parent, $templates);
        } else {
            $fullyConsumed = true;
        }

        if (isset($templates[$path->value]) && is_array($templates[$path->value])) {
            return [$templates[$path->value], $fullyConsumed];
        }

        return [$templates, false];
    }
}
