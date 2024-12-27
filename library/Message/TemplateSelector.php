<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Result;

use function count;
use function is_array;
use function is_string;
use function Respect\Stringifier\stringify;
use function sprintf;

final class TemplateSelector
{
    /** @var array<string|int, mixed> */
    public readonly array $templates;

    /** @param array<string|int, mixed> $templates */
    public function __construct(
        private readonly Result $result,
        array $templates,
    ) {
        $this->templates = $this->selectedTemplates($templates);
    }

    public function getResult(): Result
    {
        if ($this->result->hasCustomTemplate()) {
            return $this->result;
        }

        foreach ([$this->result->getDeepestPath(), $this->result->name, $this->result->id, '__root__'] as $key) {
            if (!isset($this->templates[$key])) {
                continue;
            }

            if (is_string($this->templates[$key])) {
                return $this->result->withTemplate($this->templates[$key]);
            }

            throw new ComponentException(
                sprintf('Template for "%s" must be a string, %s given', $key, stringify($this->templates[$key]))
            );
        }

        return $this->result;
    }

    public function hasOnlyItsOwnTemplate(): bool
    {
        $keys = [$this->result->getDeepestPath(), $this->result->name, $this->result->id];
        foreach ($keys as $key) {
            if (isset($this->templates[$key]) && is_string($this->templates[$key])) {
                return true;
            }
        }

        if (count($this->templates) !== 1) {
            return false;
        }

        foreach ($keys as $key) {
            if (isset($this->templates[$key])) {
                return true;
            }
        }

        return isset($this->templates['__root__']);
    }

    /**
     * @param array<string|int, mixed> $templates
     * @return array<string|int, mixed>
     */
    private function selectedTemplates(array $templates): array
    {
        foreach ([$this->result->getDeepestPath(), $this->result->name, $this->result->id] as $key) {
            if (isset($templates[$key]) && is_array($templates[$key])) {
                return $templates[$key];
            }
        }

        return $templates;
    }
}
