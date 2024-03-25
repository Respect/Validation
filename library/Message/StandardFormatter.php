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
        private readonly Renderer $renderer,
    ) {
    }

    /**
     * @param array<string, mixed> $templates
     */
    public function main(Result $result, array $templates): string
    {
        $selectedTemplates = $this->selectTemplates($result, $templates);
        if (!$this->isFinalTemplate($result, $selectedTemplates)) {
            foreach ($this->extractDeduplicatedChildren($result) as $child) {
                return $this->main($child, $selectedTemplates);
            }
        }

        return $this->renderer->render($this->getTemplated($result, $selectedTemplates));
    }

    /**
     * @param array<string, mixed> $templates
     */
    public function full(Result $result, array $templates, int $depth = 0): string
    {
        $selectedTemplates = $this->selectTemplates($result, $templates);
        $isFinalTemplate = $this->isFinalTemplate($result, $selectedTemplates);

        $rendered = '';
        if ($result->isAlwaysVisible() || $isFinalTemplate) {
            $indentation = str_repeat(' ', $depth * 2);
            $rendered .= sprintf(
                '%s- %s' . PHP_EOL,
                $indentation,
                $this->renderer->render($this->getTemplated($result, $selectedTemplates)),
            );
            $depth++;
        }

        if (!$isFinalTemplate) {
            foreach ($this->extractDeduplicatedChildren($result) as $child) {
                $rendered .= $this->full($child, $selectedTemplates, $depth);
                $rendered .= PHP_EOL;
            }
        }

        return rtrim($rendered, PHP_EOL);
    }

    /**
     * @param array<string, mixed> $templates
     *
     * @return array<string, mixed>
     */
    public function array(Result $result, array $templates): array
    {
        $selectedTemplates = $this->selectTemplates($result, $templates);
        $deduplicatedChildren = $this->extractDeduplicatedChildren($result);
        if (count($deduplicatedChildren) === 0 || $this->isFinalTemplate($result, $selectedTemplates)) {
            return [$result->id => $this->renderer->render($this->getTemplated($result, $selectedTemplates))];
        }

        $messages = [];
        foreach ($deduplicatedChildren as $child) {
            $messages[$child->id] = $this->array($child, $this->selectTemplates($child, $selectedTemplates));
            if (count($messages[$child->id]) !== 1) {
                continue;
            }

            $messages[$child->id] = current($messages[$child->id]);
        }

        if (count($messages) > 1) {
            $self = ['__root__' => $this->renderer->render($this->getTemplated($result, $selectedTemplates))];

            return $self + $messages;
        }

        return $messages;
    }

    /** @param array<string, mixed> $templates */
    private function getTemplated(Result $result, array $templates): Result
    {
        if ($result->hasCustomTemplate()) {
            return $result;
        }

        if (!isset($templates[$result->id]) && isset($templates['__root__'])) {
            return $result->withTemplate($templates['__root__']);
        }

        if (!isset($templates[$result->id])) {
            return $result;
        }

        $template = $templates[$result->id];
        if (is_string($template)) {
            return $result->withTemplate($template);
        }

        throw new ComponentException(
            sprintf('Template for "%s" must be a string, %s given', $result->id, stringify($template))
        );
    }

    /**
     * @param array<string, mixed> $templates
     */
    private function isFinalTemplate(Result $result, array $templates): bool
    {
        if (isset($templates[$result->id]) && is_string($templates[$result->id])) {
            return true;
        }

        if (count($templates) !== 1) {
            return false;
        }

        return isset($templates['__root__']) || isset($templates[$result->id]);
    }

    /**
     * @param array<string, mixed> $templates
     *
     * @return array<string, mixed>
     */
    private function selectTemplates(Result $message, array $templates): array
    {
        if (isset($templates[$message->id]) && is_array($templates[$message->id])) {
            return $templates[$message->id];
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
            $id = $child->id;
            if (isset($duplicateCounters[$id])) {
                $id .= '.' . ++$duplicateCounters[$id];
            } elseif (array_key_exists($id, $deduplicatedResults)) {
                $deduplicatedResults[$id . '.1'] = $deduplicatedResults[$id]?->withId($id . '.1');
                unset($deduplicatedResults[$id]);
                $duplicateCounters[$id] = 2;
                $id .= '.2';
            }
            $deduplicatedResults[$id] = $child->isValid ? null : $child->withId($id);
        }

        return array_values(array_filter($deduplicatedResults));
    }
}
