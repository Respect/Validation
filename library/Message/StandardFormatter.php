<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use Respect\Validation\Result;
use Respect\Validation\ResultSet;

use function array_filter;
use function array_key_exists;
use function array_reduce;
use function array_values;
use function count;
use function current;
use function rtrim;
use function sprintf;
use function str_repeat;

use const PHP_EOL;

final class StandardFormatter implements Formatter
{
    public function __construct(
        private readonly Renderer $renderer = new StandardRenderer(),
    ) {
    }

    /**
     * @param array<string|int, mixed> $templates
     */
    public function main(Result $result, array $templates, Translator $translator): string
    {
        $selector = new TemplateSelector($result, $templates);
        if (!$selector->hasOnlyItsOwnTemplate()) {
            foreach (new ResultSet($result) as $child) {
                return $this->main($child, $selector->templates, $translator);
            }
        }

        return $this->renderer->render($selector->getResult(), $translator);
    }

    /**
     * @param array<string|int, mixed> $templates
     */
    public function full(
        Result $result,
        array $templates,
        Translator $translator,
        int $depth = 0,
        Result ...$siblings
    ): string {
        $selector = new TemplateSelector($result, $templates);
        $rendered = '';
        if ($this->isAlwaysVisible($result, ...$siblings) || $selector->hasOnlyItsOwnTemplate()) {
            $indentation = str_repeat(' ', $depth * 2);
            $rendered .= sprintf(
                '%s- %s' . PHP_EOL,
                $indentation,
                $this->renderer->render(
                    $depth > 0 ? $selector->getResult()->withDeepestPath() : $selector->getResult(),
                    $translator
                ),
            );
            $depth++;
        }

        if (!$selector->hasOnlyItsOwnTemplate()) {
            $results = new ResultSet($result);
            foreach ($results as $child) {
                $rendered .= $this->full(
                    $child,
                    $selector->templates,
                    $translator,
                    $depth,
                    ...array_filter($results->getArrayCopy(), static fn (Result $sibling) => $sibling !== $child)
                );
                $rendered .= PHP_EOL;
            }
        }

        return rtrim($rendered, PHP_EOL);
    }

    /**
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    public function array(Result $result, array $templates, Translator $translator): array
    {
        $selector = new TemplateSelector($result, $templates);
        $deduplicatedChildren = $this->extractDeduplicatedChildren($result);
        if (count($deduplicatedChildren) === 0 || $selector->hasOnlyItsOwnTemplate()) {
            return [
                $result->path ?? $result->id => $this->renderer->render(
                    $selector->getResult()->withDeepestPath(),
                    $translator
                ),
            ];
        }

        $messages = [];
        foreach ($deduplicatedChildren as $child) {
            $key = $child->path ?? $child->id;
            $messages[$key] = $this->array(
                $this->resultWithPath($result, $child),
                $selector->templates,
                $translator
            );
            if (count($messages[$key]) !== 1) {
                continue;
            }

            $messages[$key] = current($messages[$key]);
        }

        if (count($messages) > 1) {
            $self = [
                '__root__' => $this->renderer->render($selector->getResult()->withDeepestPath(), $translator),
            ];

            return $self + $messages;
        }

        return $messages;
    }

    public function resultWithPath(Result $parent, Result $child): Result
    {
        if ($parent->path !== null && $child->path !== null && $child->path !== $parent->path) {
            return $child->withPath($parent->path);
        }

        if ($parent->path !== null && $child->path === null) {
            return $child->withPath($parent->path);
        }

        return $child;
    }

    private function isAlwaysVisible(Result $result, Result ...$siblings): bool
    {
        if ($result->isValid) {
            return false;
        }

        if ($result->hasCustomTemplate()) {
            return true;
        }

        $childrenAlwaysVisible = array_filter(
            $result->children,
            fn (Result $child) => $this->isAlwaysVisible($child, ...array_filter(
                $result->children,
                static fn (Result $sibling) => $sibling !== $child
            ))
        );
        if (count($childrenAlwaysVisible) !== 1) {
            return true;
        }

        if (count($siblings) === 0) {
            return false;
        }

        return array_reduce(
            $siblings,
            fn (bool $carry, Result $currentSibling) => $carry || $this->isAlwaysVisible(
                $currentSibling,
                ...array_filter($siblings, static fn (Result $sibling) => $sibling !== $currentSibling)
            ),
            true
        );
    }

    /** @return array<Result> */
    private function extractDeduplicatedChildren(Result $result): array
    {
        /** @var array<string, Result> $deduplicatedResults */
        $deduplicatedResults = [];
        $duplicateCounters = [];
        foreach ($result->children as $child) {
            if ($child->path !== null) {
                $deduplicatedResults[$child->path] = $child->isValid ? null : $child;
                continue;
            }

            $id = $child->id;
            if (isset($duplicateCounters[$id])) {
                $id .= '.' . ++$duplicateCounters[$id];
            } elseif (array_key_exists($id, $deduplicatedResults)) {
                $deduplicatedResults[$id . '.1'] = $deduplicatedResults[$id]?->withId($id . '.1');
                unset($deduplicatedResults[$id]);
                $duplicateCounters[$id] = 2;
                $id .= '.2';
            }
            $deduplicatedResults[$id] = $child->isValid ? null : $child->withId((string) $id);
        }

        return array_values(array_filter($deduplicatedResults));
    }
}
