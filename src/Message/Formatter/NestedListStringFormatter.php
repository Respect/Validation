<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\StringFormatter;
use Respect\Validation\Name;
use Respect\Validation\Result;

use function array_filter;
use function count;
use function rtrim;
use function sprintf;
use function str_repeat;

use const PHP_EOL;

final readonly class NestedListStringFormatter implements StringFormatter
{
    /** @param array<string|int, mixed> $templates */
    public function format(Result $result, Renderer $renderer, array $templates): string
    {
        return $this->formatRecursively($result, $renderer, $templates, 0, null, true);
    }

    /** @param array<string|int, mixed> $templates */
    private function formatRecursively(
        Result $result,
        Renderer $renderer,
        array $templates,
        int $depth,
        Name|null $lastVisibleName,
        bool $isRoot,
        Result ...$siblings,
    ): string {
        $formatted = '';
        if ($this->isVisible($result, ...$siblings)) {
            $indentation = str_repeat(' ', $depth * 2);
            $formatted .= sprintf(
                '%s- %s' . PHP_EOL,
                $indentation,
                $renderer->render(
                    $lastVisibleName === $result->name ? $result->withoutName() : $result,
                    $templates,
                    $isRoot,
                ),
            );
            $lastVisibleName ??= $result->name;
            $depth++;
        }

        foreach ($result->children as $child) {
            $formatted .= $this->formatRecursively(
                $child,
                $renderer,
                $templates,
                $depth,
                $lastVisibleName,
                false,
                ...array_filter($result->children, static fn(Result $sibling) => $sibling !== $child),
            );
            $formatted .= PHP_EOL;
        }

        return rtrim($formatted, PHP_EOL);
    }

    private function isVisible(Result $result, Result ...$siblings): bool
    {
        if ($result->hasCustomTemplate()) {
            return true;
        }

        if (count($result->children) !== 1) {
            return true;
        }

        foreach ($siblings as $sibling) {
            if ($sibling->hasCustomTemplate() || count($sibling->children) !== 1) {
                return true;
            }
        }

        return false;
    }
}
