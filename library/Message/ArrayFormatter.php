<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use Respect\Validation\Result;

interface ArrayFormatter
{
    /**
     * @param array<string, mixed> $templates
     *
     * @return array<string, mixed>
     */
    public function format(Result $result, Renderer $renderer, array $templates): array;
}
