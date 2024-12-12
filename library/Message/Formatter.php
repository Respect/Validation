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
    public function main(Result $result, array $templates, Translator $translator): string;

    /**
     * @param array<string, mixed> $templates
     */
    public function full(
        Result $result,
        array $templates,
        Translator $translator,
        int $depth = 0,
        Result ...$siblings
    ): string;

    /**
     * @param array<string, mixed> $templates
     *
     * @return array<string, mixed>
     */
    public function array(Result $result, array $templates, Translator $translator): array;
}
