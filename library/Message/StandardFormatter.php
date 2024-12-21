<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Result;

use function array_filter;
use function array_key_exists;
use function array_reduce;
use function array_values;
use function count;
use function current;
use function is_array;
use function is_string;
use function Respect\Stringifier\stringify;
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
        $selectedTemplates = $this->selectTemplates($result, $templates);
        if (!$this->isFinalTemplate($result, $selectedTemplates)) {
            foreach ($this->extractDeduplicatedChildren($result) as $child) {
                if ($result->path !== null && $child->path !== null && $child->path !== $result->path) {
                    $child = $child->withPath($result->path);
                } elseif ($result->path !== null && $child->path === null) {
                    $child = $child->withPath($result->path);
                }

                return $this->main($child, $selectedTemplates, $translator);
            }
        }

        return $this->renderer->render($this->getTemplated($result, $selectedTemplates), $translator);
    }

    /**
     * @param array<string|int, mixed> $templates
     */
    public function full(
        Result $result,
        array $templates,
        Translator $translator,
        int $depth = 0,
        ?Result $parent = null,
        Result ...$siblings
    ): string {
        $selectedTemplates = $this->selectTemplates($result, $templates);
        $isFinalTemplate = $this->isFinalTemplate($result, $selectedTemplates);

        $rendered = '';
        if ($this->isAlwaysVisible($result, ...$siblings) || $isFinalTemplate) {
            $indentation = str_repeat(' ', $depth * 2);
            $rendered .= sprintf(
                '%s- %s' . PHP_EOL,
                $indentation,
                $this->renderer->render($this->getTemplated($result, $selectedTemplates), $translator),
            );
            $depth++;
        }

        if (!$isFinalTemplate) {
            $results = $this->extractDeduplicatedChildren($result);
            foreach ($results as $child) {
                $rendered .= $this->full(
                    $child,
                    $selectedTemplates,
                    $translator,
                    $depth,
                    $result,
                    ...array_filter($results, static fn (Result $sibling) => $sibling !== $child)
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
        $selectedTemplates = $this->selectTemplates($result, $templates);
        $deduplicatedChildren = $this->extractDeduplicatedChildren($result);
        if (count($deduplicatedChildren) === 0 || $this->isFinalTemplate($result, $selectedTemplates)) {
            return [
                $result->path ?? $result->id => $this->renderer->render(
                    $this->getTemplated($result, $selectedTemplates),
                    $translator
                ),
            ];
        }

        $messages = [];
        foreach ($deduplicatedChildren as $child) {
            $key = $child->path ?? $child->id;
            $messages[$key] = $this->array(
                $child,
                $this->selectTemplates($child, $selectedTemplates),
                $translator
            );
            if (count($messages[$key]) !== 1) {
                continue;
            }

            $messages[$key] = current($messages[$key]);
        }

        if (count($messages) > 1) {
            $self = [
                '__root__' => $this->renderer->render($this->getTemplated($result, $selectedTemplates), $translator),
            ];

            return $self + $messages;
        }

        return $messages;
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

    /** @param array<string|int, mixed> $templates */
    private function getTemplated(Result $result, array $templates): Result
    {
        if ($result->hasCustomTemplate()) {
            return $result;
        }

        foreach ([$result->path, $result->name, $result->id, '__root__'] as $key) {
            if (!isset($templates[$key])) {
                continue;
            }

            if (is_string($templates[$key])) {
                return $result->withTemplate($templates[$key]);
            }

            throw new ComponentException(
                sprintf('Template for "%s" must be a string, %s given', $key, stringify($templates[$key]))
            );
        }

        return $result;
    }

    /**
     * @param array<string|int, mixed> $templates
     */
    private function isFinalTemplate(Result $result, array $templates): bool
    {
        $keys = [$result->path, $result->name, $result->id];
        foreach ($keys as $key) {
            if (isset($templates[$key]) && is_string($templates[$key])) {
                return true;
            }
        }

        if (count($templates) !== 1) {
            return false;
        }

        foreach ($keys as $key) {
            if (isset($templates[$key])) {
                return true;
            }
        }

        return isset($templates['__root__']);
    }

    /**
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    private function selectTemplates(Result $result, array $templates): array
    {
        foreach ([$result->path, $result->name, $result->id] as $key) {
            if (isset($templates[$key]) && is_array($templates[$key])) {
                return $templates[$key];
            }
        }

        return $templates;
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
