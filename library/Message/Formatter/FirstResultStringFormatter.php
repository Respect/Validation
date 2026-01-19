<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use Respect\Validation\Message\Renderer;
use Respect\Validation\Message\StringFormatter;
use Respect\Validation\Result;

final readonly class FirstResultStringFormatter implements StringFormatter
{
    /** @param array<string|int, mixed> $templates */
    public function format(Result $result, Renderer $renderer, array $templates): string
    {
        if (!$result->hasCustomTemplate()) {
            foreach ($result->children as $child) {
                return $this->format($child, $renderer, $templates);
            }
        }

        return $renderer->render($result, $templates);
    }
}
