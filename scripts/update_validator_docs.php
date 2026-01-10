#!/usr/bin/env php
<?php

/**
 * Script to update validator documentation files by replacing isValid() assertions
 * with assert() calls and capturing exception messages.
 * Uses a simple approach: execute code as-is instead of trying to parse and reconstruct.
 */
require __DIR__ . '/../vendor/autoload.php';

use Respect\Validation\Validator as v;
use Symfony\Component\Finder\Finder;

class MarkdownProcessor
{
    private $filePath;
    private $lines;
    private $inCodeBlock = false;
    private $currentCodeBlock = [];
    private $updatedContent = [];
    private $changesMade = false;

    public function __construct($filePath, $content)
    {
        $this->filePath = $filePath;
        $this->lines = explode("\n", $content);
    }

    public function process()
    {
        foreach ($this->lines as $line) {
            $this->processLine($line);
        }

        // Finish any open code block
        if ($this->inCodeBlock) {
            $this->finishCodeBlock();
        }

        return $this->changesMade;
    }

    private function processLine($line)
    {
        // Check if we're starting a code block
        if (strpos($line, '```php') === 0) {
            $this->startCodeBlock($line);
            return;
        }

        // Check if we're ending a code block
        if ($this->inCodeBlock && strpos($line, '```') === 0) {
            $this->currentCodeBlock[] = $line;
            $this->finishCodeBlock();
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

    private function startCodeBlock($line)
    {
        $this->inCodeBlock = true;
        $this->currentCodeBlock = [$line];
    }

    private function finishCodeBlock()
    {
        $originalCodeBlock = $this->currentCodeBlock;
        $processedLines = $this->processCodeBlock($this->currentCodeBlock);

        // Only update if changes were made
        if ($processedLines !== $originalCodeBlock) {
            $this->changesMade = true;
            $this->updatedContent = array_merge($this->updatedContent, $processedLines);
        } else {
            $this->updatedContent = array_merge($this->updatedContent, $originalCodeBlock);
        }

        // Add empty line after code block if next line isn't empty or another code block
        $nextIndex = count($this->updatedContent);
        if ($nextIndex < count($this->lines) && !empty($this->lines[$nextIndex]) && strpos($this->lines[$nextIndex], '```') !== 0) {
            $this->updatedContent[] = '';
        }

        // Remove trailing empty lines
        while (end($this->updatedContent) === '') {
            array_pop($this->updatedContent);
        }

        $this->inCodeBlock = false;
        $this->currentCodeBlock = [];
    }

    private function processCodeBlock($lines)
    {
        $processedLines = [];
        $codeLines = [];

        // Extract code lines (skip the ```php and ``` markers)
        for ($i = 1; $i < count($lines) - 1; $i++) {
            $codeLines[] = $lines[$i];
        }

        $processedCodeLines = $this->processCodeLines($codeLines);

        // Rebuild the code block
        $processedLines[] = $lines[0]; // ```php
        $processedLines = array_merge($processedLines, $processedCodeLines);
        $processedLines[] = end($lines); // ```

        return $processedLines;
    }

    private function processCodeLines($codeLines)
    {
        $processedLines = [];
        $currentStatement = [];
        $inStatement = false;

        foreach ($codeLines as $codeLine) {
            // Check if line starts a new statement (starts with v::)
            if (strpos(trim($codeLine), 'v::') === 0) {
                // If we were in a statement, process it first
                if ($inStatement) {
                    $processedStatement = $this->processStatement($currentStatement);
                    $processedLines = array_merge($processedLines, $processedStatement);
                    $currentStatement = [];
                }
                $inStatement = true;
                $currentStatement[] = $codeLine;
            }
            // If we're in a statement and line ends with ;, complete the statement
            elseif ($inStatement && strpos($codeLine, ';') !== false) {
                $currentStatement[] = $codeLine;
                $processedStatement = $this->processStatement($currentStatement);
                $processedLines = array_merge($processedLines, $processedStatement);
                $currentStatement = [];
                $inStatement = false;
            }
            // If we're in a statement, continue collecting lines
            elseif ($inStatement) {
                $currentStatement[] = $codeLine;
            }
            // Regular line (not part of a v:: statement)
            else {
                $processedLines[] = $codeLine;
            }
        }

        // Process any remaining statement
        if ($inStatement) {
            $processedStatement = $this->processStatement($currentStatement);
            $processedLines = array_merge($processedLines, $processedStatement);
        }

        // Remove trailing empty lines
        while (array_last($processedLines) === '') {
            array_pop($processedLines);
        }

        return $processedLines;
    }

    private function processStatement($statementLines)
    {
        $processedLines = [];
        $originalStatement = implode("\n", $statementLines);

        // Simple pattern: just look for ->isValid(
        if (strpos($originalStatement, '->isValid(') === false) {
            // No isValid found, return original lines
            $processedLines = $statementLines;
            // Add empty line after any statement ending with ;
            if (!empty($statementLines) && strpos(end($statementLines), ';') !== false) {
                $processedLines[] = '';
            }
            return $processedLines;
        }

        // Replace ->isValid( with ->assert(
        $newStatement = str_replace('->isValid(', '->assert(', $originalStatement);

        // Remove // true or // false comments if present
        $newStatement = preg_replace('/\s*\/\/ (true|false)/', '', $newStatement);

        // Execute the code to get the exception message
        $exceptionMessage = '';
        try {
            $releaseDates = [
                'validation' => '2010-01-01',
                'template'   => '2011-01-01',
                'relational' => '2011-02-05',
            ];
            $filename = 'file.txt';
            $object = new stdClass();
            eval(str_replace(
                ['__DIR__', '__FILE__'],
                ['"'.__DIR__.'"', '"'.__FILE__.'"'],
                $newStatement));
        } catch (Throwable $e) {
            $exceptionMessage = str_replace(
                [__DIR__, __FILE__],
                ['/path/to/dir', '/path/to/file.txt'],
                $e->getMessage()
            );
        }


        // Add exception message comment if present
        if (!empty($exceptionMessage)) {
            $processedLines[] = $newStatement;
            $processedLines[] = "// → {$exceptionMessage}";
        } else {
            // Add the new statement
            $processedLines[] = $newStatement;
            $processedLines[] = "// Validation passes successfully";
        }

        // Add empty line after statement (but not if it's the last line in the code block)
        $nextLineIndex = array_search($statementLines[0], $this->lines) + count($statementLines);
        if ($nextLineIndex < count($this->lines) && strpos($this->lines[$nextLineIndex], '```') !== 0) {
            $processedLines[] = '';
        }

        $this->changesMade = true;
        return $processedLines;
    }

    public function getUpdatedContent()
    {
        return implode("\n", $this->updatedContent);
    }
}

// Main execution
$docsPath = __DIR__ . '/../docs/validators';
$finder = new Finder();
$finder->files()
       ->in($docsPath)
       ->name('*.md');

$filesProcessed = 0;
$filesUpdated = 0;

foreach ($finder as $file) {
    $filePath = $file->getRealPath();
    $content = $file->getContents();

    $processor = new MarkdownProcessor($filePath, $content);
    $changesMade = $processor->process();

    if ($changesMade) {
        $updatedContent = $processor->getUpdatedContent();
        file_put_contents($filePath, $updatedContent);
        echo "Updated: " . basename($filePath) . "\n";
        $filesUpdated++;
    }

    $filesProcessed++;
}

echo "\nProcessing complete!\n";
echo "Files processed: $filesProcessed\n";
echo "Files updated: $filesUpdated\n";
