<?php

declare(strict_types=1);

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

namespace Respect\Dev\Helpers;

use ArrayObject;
use DateTimeImmutable;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Expression;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard as PrettyPrinter;
use Respect\Validation\Exceptions\ValidationException;
use Throwable;
use UnexpectedValueException;

use function array_keys;
use function array_merge;
use function array_pop;
use function array_slice;
use function array_values;
use function count;
use function date;
use function explode;
use function implode;
use function preg_match;
use function sprintf;
use function str_contains;
use function str_replace;
use function str_starts_with;
use function substr;
use function substr_count;
use function trim;

use const PHP_EOL;

final class MarkdownProcessor
{
    private const string FIXED_DATETIME = '2024-01-01 12:00:00+00:00';

    private bool $inCodeBlock = false;

    /** @var string[] */
    private array $currentCodeBlock = [];

    /** @var string[] */
    private array $updatedContent = [];

    /** @param string[] $lines */
    public function __construct(
        private readonly array $lines,
    ) {
    }

    public static function fromContent(string $content): self
    {
        return new self(explode(PHP_EOL, $content));
    }

    public function process(): string
    {
        $context = new ArrayObject();
        foreach ($this->lines as $line) {
            $this->processLine($line, $context);
        }

        return implode("\n", $this->updatedContent);
    }

    private function processLine(string $line, ArrayObject $context): void
    {
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

        if ($this->inCodeBlock) {
            $this->currentCodeBlock[] = $line;

            return;
        }

        $this->updatedContent[] = $line;
    }

    /**
     * @param string[] $lines
     *
     * @return string[]
     */
    private function processCodeBlock(array $lines, ArrayObject $context): array
    {
        $openingLine = $lines[0];
        $closingLine = $lines[count($lines) - 1];
        $codeLines = array_slice($lines, 1, -1);
        $code = implode("\n", $codeLines);

        $processedCodeLines = $this->processCode($code, $context);

        return [
            $openingLine,
            ...$processedCodeLines,
            $closingLine,
        ];
    }

    /** @return string[] */
    private function processCode(string $code, ArrayObject $context): array
    {
        // Strip existing output comments before parsing
        $cleanedCode = $this->stripOutputComments($code);

        $parser = (new ParserFactory())->createForNewestSupportedVersion();
        $printer = new PrettyPrinter();

        // Prepend <?php tag for parsing, we'll account for its length when extracting
        $phpTagLength = 6;
        $fullCode = '<?php ' . $cleanedCode;

        try {
            $statements = $parser->parse($fullCode);
        } catch (Throwable $exception) {
            throw new UnexpectedValueException(sprintf('Failed to parse code block: %s', $code), 0, $exception);
        }

        $processedLines = [];
        $lastEndPos = $phpTagLength; // Start after <?php tag
        $lastWasAssertion = false;

        foreach ($statements as $statement) {
            // Extract the original source code using position information
            $startPos = $statement->getStartFilePos();
            $endPos = $statement->getEndFilePos();

            // Preserve blank lines between statements (unless previous was assertion,
            // since assertions already add a trailing blank line)
            if ($startPos > $lastEndPos && !$lastWasAssertion) {
                $between = substr($fullCode, $lastEndPos, $startPos - $lastEndPos);
                // Count newlines: 1 newline = end of previous line, 2+ = blank lines
                $newlineCount = substr_count($between, "\n");
                for ($i = 1; $i < $newlineCount; $i++) {
                    $processedLines[] = '';
                }
            }

            if ($startPos >= 0 && $endPos >= 0) {
                // Extract the statement code and include trailing comment on the same line
                $statementCode = substr($fullCode, $startPos, $endPos - $startPos + 1);

                // Check if there's a trailing comment on the same line
                $restOfCode = substr($fullCode, $endPos + 1);
                if (preg_match('/^(\h*\/\/[^\n]*)/u', $restOfCode, $matches)) {
                    $statementCode .= $matches[1];
                }
            } else {
                // Fallback to pretty printer if positions aren't available
                $statementCode = $printer->prettyPrint([$statement]);
            }

            // Check if this is a validation assertion (calls assert/check on v::)
            $isAssertion = $this->isValidationAssertion($statement);
            if ($isAssertion) {
                $processedLines[] = $statementCode;
                $contextHasClass = $this->contextContainsClass($context);
                $result = $this->executeStatement($statementCode, $context, $printer);
                $processedLines = array_merge($processedLines, $result);

                // Clear context after executing an assertion that included a class
                // to prevent "Cannot redeclare class" errors on subsequent assertions
                if ($contextHasClass) {
                    $context->exchangeArray([]);
                }
            } else {
                // Add to context for later execution (use pretty printed for eval)
                $context->append($printer->prettyPrint([$statement]));
                $processedLines[] = $statementCode;
            }

            // Update tracking variables
            $lastEndPos = $endPos + 1;
            $lastWasAssertion = $isAssertion;
        }

        // Remove trailing empty lines
        while (count($processedLines) > 0 && trim($processedLines[count($processedLines) - 1]) === '') {
            array_pop($processedLines);
        }

        return $processedLines;
    }

    /**
     * Strip existing output comments from code
     */
    private function stripOutputComments(string $code): string
    {
        $lines = explode("\n", $code);
        $filteredLines = [];

        foreach ($lines as $line) {
            $trimmed = trim($line);

            // Skip output comment lines (whole line comments only)
            if ($trimmed === '// Validation passes successfully') {
                continue;
            }

            if (str_starts_with($trimmed, '// →')) {
                continue;
            }

            $filteredLines[] = $line;
        }

        // Remove consecutive empty lines
        $result = [];
        $lastWasEmpty = false;
        foreach ($filteredLines as $line) {
            $isEmpty = trim($line) === '';
            if ($isEmpty && $lastWasEmpty) {
                continue;
            }

            $result[] = $line;
            $lastWasEmpty = $isEmpty;
        }

        // Remove trailing empty lines
        while (count($result) > 0 && trim($result[count($result) - 1]) === '') {
            array_pop($result);
        }

        return implode("\n", $result);
    }

    /**
     * Check if the statement is a validation assertion (v::...->assert(), or $var->assert/check())
     */
    private function isValidationAssertion(Node $statement): bool
    {
        if (!$statement instanceof Expression) {
            return false;
        }

        $expr = $statement->expr;

        if (!$expr instanceof MethodCall) {
            return false;
        }

        $methodName = $expr->name;
        if (!$methodName instanceof Identifier) {
            return false;
        }

        if ($methodName->name !== 'assert') {
            return false;
        }

        // Accept if it originates from v:: OR if it's called on a variable
        // (variables in doc examples are typically validators)
        return $this->originatesFromV($expr) || $this->originatesFromVariable($expr);
    }

    /**
     * Check if a method call chain originates from v:: static call
     */
    private function originatesFromV(Node $node): bool
    {
        if ($node instanceof StaticCall) {
            $class = $node->class;

            return $class instanceof Name && $class->toString() === 'v';
        }

        if ($node instanceof MethodCall) {
            return $this->originatesFromV($node->var);
        }

        return false;
    }

    /**
     * Check if a method call chain originates from a variable (e.g., $validator->assert())
     */
    private function originatesFromVariable(Node $node): bool
    {
        if ($node instanceof Node\Expr\Variable) {
            return true;
        }

        if ($node instanceof MethodCall) {
            return $this->originatesFromVariable($node->var);
        }

        return false;
    }

    /**
     * Check if context contains a class definition
     */
    private function contextContainsClass(ArrayObject $context): bool
    {
        $fullContext = implode("\n", $context->getArrayCopy());

        return (bool) preg_match('/^(final\s+)?class\s+[A-Za-z_][A-Za-z0-9_]*/m', $fullContext);
    }

    /** @return string[] */
    private function executeStatement(string $statementCode, ArrayObject $context, PrettyPrinter $printer): array
    {
        $fullCode = implode("\n", [...$context->getArrayCopy(), $statementCode]);
        $fullCode = $this->replacePlaceholders($fullCode);

        $resultLines = [];

        try {
            eval($fullCode);

            if (str_contains($statementCode, 'assert(')) {
                $resultLines[] = '// Validation passes successfully';
            }
        } catch (ValidationException $e) {
            $fullMessage = $e->getFullMessage();
            if (str_contains($fullMessage, PHP_EOL)) {
                foreach (explode(PHP_EOL, trim($fullMessage)) as $line) {
                    $resultLines[] = '// → ' . $this->formatExceptionMessage($line);
                }
            } else {
                $resultLines[] = '// → ' . $this->formatExceptionMessage($e->getMessage());
            }
        } catch (Throwable $e) {
            $resultLines[] = '// 𝙭 ' . $this->formatExceptionMessage($e->getMessage());
        }

        if (count($resultLines) > 0) {
            $resultLines[] = '';
        }

        return $resultLines;
    }

    private function replacePlaceholders(string $code): string
    {
        return str_replace(array_keys($this->getReplacements()), array_values($this->getReplacements()), $code);
    }

    private function formatExceptionMessage(string $line): string
    {
        return str_replace(array_values($this->getReplacements()), array_keys($this->getReplacements()), $line);
    }

    private function getReplacements(): array
    {
        $dateTime = new DateTimeImmutable(self::FIXED_DATETIME);

        return [
            '/path/to/file.txt' => 'tests/fixtures/file.txt',
            '/path/to/file' => 'tests/fixtures/file',
            '/path/to/symbolic-link' => 'tests/fixtures/symbolic-link',
            '/path/to/executable' => 'tests/fixtures/executable',
            '/path/to/non-writable' => 'tests/fixtures/non-writable',
            '/path/to/image.gif' => 'tests/fixtures/valid-image.gif',
            '/path/to/image.png' => 'tests/fixtures/valid-image.png',
            '/path/to/image.jpg' => 'tests/fixtures/valid-image.jpg',
            '/path/to/dir' => 'tests/fixtures',
            '__FILE__' => '"tests/fixtures/file"',
            '__DIR__' => '"tests/fixtures"',
            'new DateTime()' => 'new DateTime(\'' . self::FIXED_DATETIME . '\')',
            'new DateTimeImmutable()' => 'new DateTimeImmutable(\'' . self::FIXED_DATETIME . '\')',
            date('d/m/Y') => $dateTime->format('d/m/Y'),
            $dateTime->format('d/m/Y') => date('d/m/Y'),
            'new ClassWithToString()' => 'new \Respect\Validation\Test\Stubs\ToStringStub("string")',
        ];
    }
}
