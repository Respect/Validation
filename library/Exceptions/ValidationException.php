<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use InvalidArgumentException;

final class ValidationException extends InvalidArgumentException implements Exception
{
    /** @param array<string, mixed> $messages */
    public function __construct(
        string $message,
        private readonly string $fullMessage,
        private readonly array $messages,
    ) {
        parent::__construct($message);
    }

    public function getFullMessage(): string
    {
        return $this->fullMessage;
    }

    /** @return array<string, mixed> */
    public function getMessages(): array
    {
        return $this->messages;
    }
}
