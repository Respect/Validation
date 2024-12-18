<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use InvalidArgumentException;

use function realpath;

final class ValidationException extends InvalidArgumentException implements Exception
{
    /** @param array<string, mixed> $messages */
    public function __construct(
        string $message,
        private readonly string $fullMessage,
        private readonly array $messages,
    ) {
        if (realpath($this->file) === realpath(__DIR__ . '/../Validator.php')) {
            $this->file = $this->getTrace()[0]['file'] ?? $this->file;
            $this->line = $this->getTrace()[0]['line'] ?? $this->line;
        }
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
