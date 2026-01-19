<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Message;

use Respect\Validation\Message\Renderer;
use Respect\Validation\Result;

final class TestingMessageRenderer implements Renderer
{
    /** @param array<string|int, mixed> $templates */
    public function render(Result $result, array $templates): string
    {
        return $result->template;
    }
}
