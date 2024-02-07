<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use Respect\Validation\Result;

interface Formatter
{
    /**
     * @param array<string, mixed> $templates
     */
    public function main(Result $result, array $templates): string;

    /**
     * @param array<string, mixed> $templates
     */
    public function full(Result $result, array $templates, int $depth = 0): string;

    /**
     * @param array<string, mixed> $templates
     *
     * @return array<string, mixed>
     */
    public function array(Result $result, array $templates): array;
}
