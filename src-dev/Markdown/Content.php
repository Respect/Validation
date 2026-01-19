<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Markdown;

use ArrayIterator;
use IteratorAggregate;
use UnexpectedValueException;

use function array_find_key;
use function array_map;
use function array_slice;
use function count;
use function explode;
use function file_get_contents;
use function implode;
use function max;
use function preg_match;
use function reset;
use function rtrim;
use function sprintf;
use function str_pad;
use function str_repeat;
use function str_replace;
use function str_starts_with;
use function strlen;
use function strrpos;
use function trim;

use const PHP_EOL;

final class Content implements IteratorAggregate
{
    public const string REFERENCES_SECTION = '/^\[.+\]: .+$/';

    public function __construct(
        /** @var array<string> */
        private array $lines = [],
    ) {
    }

    public static function from(string $filename): self
    {
        return new self(explode(PHP_EOL, file_get_contents($filename)));
    }

    public function build(): string
    {
        return trim(implode(PHP_EOL, $this->lines)) . PHP_EOL;
    }

    public function raw(string ...$lines): void
    {
        $this->lines = [...$this->lines, ...$lines];
    }

    public function paragraph(string $text): void
    {
        $this->lines[] = $text;
    }

    public function emptyLine(): void
    {
        $this->lines[] = '';
    }

    public function hr(): void
    {
        $this->lines[] = '---' . PHP_EOL;
    }

    public function heading(string $title, int $level): void
    {
        $this->lines[] = str_repeat('#', $level) . ' ' . $title . PHP_EOL;
    }

    public function h1(string $title): void
    {
        $this->heading($title, 1);
    }

    public function h2(string $title): void
    {
        $this->heading($title, 2);
    }

    public function h3(string $title): void
    {
        $this->heading($title, 3);
    }

    public function listItem(string $item): void
    {
        $this->lines[] = '- ' . $item;
    }

    public function anchorListItem(string $title, string $href): void
    {
        $this->listItem(sprintf('[%s](%s)', $title, $href));
    }

    public function extractSpdx(): self
    {
        $start = 0;
        $end = 0;
        foreach ($this->lines as $position => $line) {
            if (preg_match('/^<!--/', $line) === 1) {
                $start = $position;
                continue;
            }

            if (preg_match('/-->/', $line) === 1) {
                $end = $position;
                break;
            }
        }

        return new self(array_slice($this->lines, $start, $end + 2));
    }

    public function withSection(Content $content): self
    {
        $firstLine = reset($content->lines);

        // Strip trailing whitespace/newlines for comparison
        $firstLineTrimmed = rtrim($firstLine);
        $sectionStart = array_find_key($this->lines, static fn($line) => $line === $firstLineTrimmed);

        // If exact match not found, try comparing trimmed versions
        if ($sectionStart === null) {
            $sectionStart = array_find_key($this->lines, static fn($line) => rtrim($line) === $firstLineTrimmed);
        }

        if ($sectionStart === null) {
            return new self([...$this->lines, ...$content->lines]);
        }

        $headingLevel = str_starts_with($firstLine, '#') ? strrpos($firstLine, '#') + 1 : 0;
        $sectionEnd = count($this->lines) - 1;

        for ($index = $sectionStart + 1; $index < count($this->lines); $index++) {
            $currentLine = $this->lines[$index];
            if (
                $headingLevel === 0
                && (str_starts_with($currentLine, '#') || preg_match(self::REFERENCES_SECTION, $currentLine) === 1)
            ) {
                $sectionEnd = $index;
                break;
            }

            if (
                ($headingLevel > 0 && str_starts_with($currentLine, str_repeat('#', $headingLevel) . ' '))
                || preg_match(self::REFERENCES_SECTION, $currentLine) === 1
            ) {
                $sectionEnd = $index;
                break;
            }
        }

        $before = array_slice($this->lines, 0, $sectionStart);
        $after = array_slice($this->lines, $sectionEnd);

        return new self([...$before, ...$content->lines, ...$after]);
    }

    public function getSection(string $text): self
    {
        $sectionStart = array_find_key($this->lines, static fn($line) => $line === $text);
        if ($sectionStart === null) {
            throw new UnexpectedValueException('Section not found: ' . $text . ': ' . implode(', ', $this->lines));
        }

        $headingLevel = str_starts_with($text, '#') ? strrpos($text, '#') + 1 : 0;
        $sectionEnd = count($this->lines);
        for ($index = $sectionStart + 1; $index < count($this->lines); $index++) {
            $currentLine = $this->lines[$index];
            if (
                $headingLevel === 0
                && (str_starts_with($currentLine, '#') || preg_match(self::REFERENCES_SECTION, $currentLine) === 1)
            ) {
                $sectionEnd = $index;
                break;
            }

            if (
                str_starts_with($currentLine, str_repeat('#', $headingLevel) . ' ')
                || preg_match(self::REFERENCES_SECTION, $currentLine) === 1
            ) {
                $sectionEnd = $index;
                break;
            }
        }

        return new self(array_slice($this->lines, $sectionStart, $sectionEnd - $sectionStart));
    }

    /**
     * @param array<int, string>             $headers
     * @param array<int, array<int, string>> $rows
     */
    public function table(array $headers, array $rows): void
    {
        $lengths = [];

        $filteredHeaders = [];
        foreach ($headers as $key => $header) {
            $filteredHeader = $this->formatTableCell($header);
            $filteredHeaders[$key] = $filteredHeader;

            $lengths[$key] ??= 0;
            $lengths[$key] = max($lengths[$key], strlen($filteredHeader));
        }

        $filteredRows = [];
        foreach ($rows as $rowIndex => $row) {
            $filteredRows[$rowIndex] = [];
            foreach ($row as $key => $cell) {
                $filteredCell = $this->formatTableCell($cell);
                $filteredRows[$rowIndex][$key] = $filteredCell;
                $lengths[$key] ??= 0;
                $lengths[$key] = max($lengths[$key], strlen($filteredCell));
            }
        }

        $this->lines[] = $this->formatTableRow($filteredHeaders, $lengths);
        $this->lines[] = $this->formatTableRow(
            array_map(static fn(int $length) => str_repeat('-', $length), $lengths),
            $lengths,
        );
        $this->lines = [
            ...$this->lines,
            ...array_map(fn(array $row) => $this->formatTableRow($row, $lengths), $filteredRows),
            '',
        ];
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->lines);
    }

    /** @return array<string> */
    public function toArray(): array
    {
        return $this->lines;
    }

    private function formatTableCell(string $value): string
    {
        return str_replace('|', '&#124;', $value);
    }

    /**
     * @param array<int, string> $row
     * @param array<int, int>    $lengths
     */
    private function formatTableRow(array $row, array $lengths): string
    {
        $cells = [];
        foreach ($row as $key => $cell) {
            $cells[] = str_pad($cell, $lengths[$key] ?? strlen($cell));
        }

        return '| ' . implode(' | ', $cells) . ' |';
    }
}
