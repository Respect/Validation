<?php

declare(strict_types=1);

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

namespace Respect\Dev\Helpers;

use Respect\Validation\Exceptions\ValidationException;
use Throwable;
use function array_last;
use function array_merge;
use function array_pop;
use function array_search;
use function count;
use function end;
use function explode;
use function implode;
use function preg_replace;
use function str_replace;
use function strpos;
use function trim;

final class MarkdownProcessor
{
    private bool $inCodeBlock = false;

    private array $currentCodeBlock = [];

    private array $updatedContent = [];

    public function __construct(
        private readonly array $lines
    ) {
    }

    public static function fromContent(string $content): self
    {
        return new self(explode(PHP_EOL, $content));
    }

    public function process(): string
    {
        $context = [];
        foreach ($this->lines as $line) {
            $this->processLine($line, $context);
        }

        return implode("\n", $this->updatedContent);
    }

    private function processLine(string $line, array &$context): void
    {
        // Check if we're starting a code block
        if (str_starts_with($line, '```php')) {
            $this->inCodeBlock = true;
            $this->currentCodeBlock = [$line];

            return;
        }
        if ($this->inCodeBlock && str_starts_with($line, '```')) {
            $this->currentCodeBlock[] = $line;

            $processedLines = $this->processCodeBlock($this->currentCodeBlock, $context);

            $this->updatedContent = array_merge($this->updatedContent, $processedLines);
            $this->inCodeBlock = false;
            $this->currentCodeBlock = [];

            return;
        }

        // If we're in a code block, collect the content
        if ($this->inCodeBlock) {
            $this->currentCodeBlock[] = $line;

            return;
        }

        // Regular line outside code blocks
        $this->updatedContent[] = $line;
    }

    private function processCodeBlock(array $lines, array &$context): array
    {
        return [
            array_first($lines),
            ...$this->processCodeLines(array_slice($lines, 1, -1), $context),
            array_last($lines),
        ];
    }

    private function processCodeLines(array $codeLines, array &$context): array
    {
        $processedLines = [];
        $statement = [];
        $inStatement = false;

        foreach ($codeLines as $codeLine) {
            // Check if line starts a new statement (starts with v::)
            if (str_starts_with($codeLine, 'v::')) {
                // If we were in a statement, process it first
                if ($inStatement) {
                    $processedStatement = $this->execute($statement, $context);
                    $processedLines = array_merge($processedLines, $processedStatement);
                    $statement = [];
                }

                $inStatement = true;
                $statement[] = $codeLine;
                continue;
            }

            // If we're in a statement and line ends with ;, complete the statement
            if ($inStatement && str_contains($codeLine, ';')) {
                $statement[] = $codeLine;
                $processedStatement = $this->execute($statement, $context);
                $processedLines = array_merge($processedLines, $processedStatement);
                $statement = [];
                $inStatement = false;
                continue;
            }

            if ($codeLine === '// Validation passes successfully'
                || str_starts_with($codeLine, '// message:')
                || str_starts_with($codeLine, '// Message:')
                || str_starts_with($codeLine, '// No exception')
                || str_starts_with($codeLine, '// →')) {
                continue;
            }

            $context[] = $codeLine;

            // If we're in a statement, continue collecting lines
            if ($inStatement) {
                $statement[] = $codeLine;
                continue;
            }

            $processedLines[] = $codeLine;
        }

        // If we ended while still in a statement, process it
        $lastStatementLine = array_last($statement);
        if ($inStatement &&  str_contains($lastStatementLine, ';')) {
            $processedStatement = $this->execute($statement, $context);
            $processedLines = array_merge($processedLines, $processedStatement);
        } else {
            // Append any remaining context lines
            $processedLines = array_merge($processedLines, $statement);
        }


        // Remove trailing empty lines
        while (array_last($processedLines) === '') {
            array_pop($processedLines);
        }

        return $processedLines;
    }

    private function execute(array $statementLines, array &$contextLines): array
    {
        $processedLines = $statementLines;
        while(array_last($processedLines) === '') {
            array_pop($processedLines);
        }
        $statement = implode("\n", [...$contextLines, ...$statementLines]);

        try {
            eval(str_replace(
                [
                    '__DIR__',
                    '__FILE__',
                    '/path/to/dir',
                    '/path/to/file.txt',
                ],
                [
                    '"' . __DIR__ . '"',
                    '"' . __FILE__ . '"',
                    __DIR__,
                    __FILE__,
                ],
                $statement,
            ));

            if (str_contains($statement, 'assert(')) {
                // If the statement contains an assert, we assume it passes
                $processedLines[] = '// Validation passes successfully';
            }
        } catch (ValidationException $e) {
            if (str_contains($e->getFullMessage(), PHP_EOL)) {
                foreach (explode(PHP_EOL, trim($e->getFullMessage())) as $line) {
                    $processedLines[] = '// → ' . str_replace(
                        [__DIR__, __FILE__],
                        ['/path/to/dir', '/path/to/file.txt'],
                        $line,
                    );
                }
            } else {
                $processedLines[] = '// → ' . str_replace(
                    [__DIR__, __FILE__],
                    ['/path/to/dir', '/path/to/file.txt'],
                    $e->getMessage(),
                );
            }
        } catch (Throwable $e) {
            $processedLines[] = '// 𝙭 ' . str_replace(
                [__FILE__, __DIR__],
                ['/path/to/file.txt', '/path/to/dir'],
                $e->getMessage(),
            );
        }
        $processedLines[] = '';

        if (str_contains($statement, 'final class Person')) {
            $contextLines = [];
        }

        return $processedLines;
    }
}
