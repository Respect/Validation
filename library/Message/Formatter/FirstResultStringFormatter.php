<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\StringFormatter;
use Respect\Validation\Name;
use Respect\Validation\Result;

final readonly class FirstResultStringFormatter implements StringFormatter
{
    /** @param array<string|int, mixed> $templates */
    public function format(Result $result, Renderer $renderer, array $templates): string
    {
        return $this->formatResult($result, $renderer, $templates, null);
    }

    /** @param array<string|int, mixed> $templates */
    private function formatResult(Result $result, Renderer $renderer, array $templates, Name|null $parentName): string
    {
        if (!$result->hasCustomTemplate()) {
            foreach ($result->children as $child) {
                return $this->formatResult($child, $renderer, $templates, $result->name ?? $parentName);
            }
        }

        if ($parentName !== null) {
            $result = $result->withName($parentName);
        }

        return $renderer->render($result, $templates);
    }
}
