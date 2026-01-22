<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Andy Wendt <andy@awendt.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jean Pimentel <jeanfap@gmail.com>
 * SPDX-FileContributor: Marcel Voigt <mv@noch.so>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Torben Brodt <t.brodt@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use InvalidArgumentException;
use Respect\Validation\ResultQuery;

use function array_shift;
use function in_array;
use function realpath;

final class ValidationException extends InvalidArgumentException implements Exception
{
    public function __construct(
        string $message,
        private readonly ResultQuery $resultQuery,
        string ...$ignoredBacktracePaths,
    ) {
        $this->overwriteFileAndLine($ignoredBacktracePaths);

        parent::__construct($message);
    }

    public function getFullMessage(): string
    {
        return $this->resultQuery->getFullMessage();
    }

    /** @return array<string|int, mixed> */
    public function getMessages(): array
    {
        return $this->resultQuery->getMessages();
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
