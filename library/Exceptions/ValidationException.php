<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use InvalidArgumentException;

use function array_shift;
use function in_array;
use function realpath;

final class ValidationException extends InvalidArgumentException implements Exception
{
    /**
     * @param array<string|int, mixed> $messages
     * @param array<string>            $ignoredBacktracePaths
     */
    public function __construct(
        string $message,
        private readonly string $fullMessage,
        private readonly array $messages,
        array $ignoredBacktracePaths = [],
    ) {
        $this->overwriteFileAndLine($ignoredBacktracePaths);

        parent::__construct($message);
    }

    public function getFullMessage(): string
    {
        return $this->fullMessage;
    }

    /** @return array<string|int, mixed> */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /** @param array<string> $ignoredBacktracePaths */
    private function overwriteFileAndLine(array $ignoredBacktracePaths = []): void
    {
        if ($ignoredBacktracePaths === []) {
            return;
        }

        $currentTrace = $this->getTrace();
        $currentFile = $this->file;
        $currentLine = $this->line;
        while (in_array(realpath($currentFile), $ignoredBacktracePaths, true)) {
            $top = array_shift($currentTrace);
            if ($top === false || !isset($top['file']) || !isset($top['line'])) {
                $currentFile = $currentLine = null;
                break;
            }

            $currentFile = $top['file'];
            $currentLine = $top['line'];
        }

        $this->file = $currentFile ?? $this->file;
        $this->line = $currentLine ?? $this->line;
    }
}
