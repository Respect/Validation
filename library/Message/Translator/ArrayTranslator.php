<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Translator;

use Respect\Validation\Message\Translator;

use function is_string;

final readonly class ArrayTranslator implements Translator
{
    /** @param array<string, string> $messages */
    public function __construct(
        private array $messages,
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
