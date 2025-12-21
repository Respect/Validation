<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use Respect\Validation\Result;

interface StringFormatter
{
    /** @param array<string, mixed> $templates */
    public function format(Result $result, Renderer $renderer, array $templates): string;
}
