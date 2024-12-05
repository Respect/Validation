<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Translator;

use Respect\Validation\Message\Translator;

use function is_string;

final class ArrayTranslator implements Translator
{
    /** @param array<string, string> $messages */
    public function __construct(
        private readonly array $messages
    ) {
    }

    public function translate(string $message): string
    {
        if (isset($this->messages[$message]) && is_string($this->messages[$message])) {
            return $this->messages[$message];
        }

        return $message;
    }
}
