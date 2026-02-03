<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Markdown\Linters;

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
use Respect\Dev\Markdown\Content;
use Respect\Dev\Markdown\File;
use Respect\Dev\Markdown\Linter;
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
use function str_ends_with;
use function str_replace;
use function str_starts_with;
use function strpos;
use function substr;
use function substr_count;
use function trim;

use const PHP_EOL;

final readonly class AssertionMessageLinter implements Linter
{
    private const string FIXED_DATETIME = '2024-01-01 12:00:00+00:00';

    public function lint(File $file): File
    {
        if (!str_contains($file->filename, '/validators/') || !str_ends_with($file->filename, '.md')) {
            return $file;
        }

        $processedContent = $this->processContent($file->content);

        if ($file->content->build() === $processedContent->build()) {
            return $file;
        }

        return $file->withContent($processedContent);
    }

    private function processContent(Content $content): Content
    {
        $context = new ArrayObject();
        $newContent = new Content();
        $inCodeBlock = false;
        $currentCodeBlock = [];
        $isFirstCodeBlock = true;

        foreach ($content as $line) {
            if (str_starts_with($line, '```php')) {
                $inCodeBlock = true;
                $currentCodeBlock = [$line];
                continue;
            }

            if ($inCodeBlock && str_starts_with($line, '```')) {
                $currentCodeBlock[] = $line;
                $processedLines = $this->processCodeBlock($currentCodeBlock, $context, $isFirstCodeBlock);

                foreach ($processedLines as $processedLine) {
                    $newContent->raw($processedLine);
                }

                $inCodeBlock = false;
                $currentCodeBlock = [];
                $isFirstCodeBlock = false;
                continue;
            }

            if ($inCodeBlock) {
                $currentCodeBlock[] = $line;
                continue;
            }

            $newContent->raw($line);
        }

        return $newContent;
    }

    /**
     * @param string[] $lines
     *
     * @return string[]
     */
    private function processCodeBlock(array $lines, ArrayObject $context, bool $isFirstCodeBlock): array
    {
        $openingLine = $lines[0];
        $closingLine = $lines[count($lines) - 1];
        $codeLines = array_slice($lines, 1, -1);
        $code = implode("\n", $codeLines);

        $processedCodeLines = $this->processCode($code, $context, $isFirstCodeBlock);

        return [
            $openingLine,
            ...$processedCodeLines,
            $closingLine,
        ];
    }

    /** @return string[] */
    private function processCode(string $code, ArrayObject $context, bool $isFirstCodeBlock): array
    {
        $cleanedCode = $this->stripOutputComments($code);

        $parser = (new ParserFactory())->createForNewestSupportedVersion();
        $printer = new PrettyPrinter();

        $phpTagLength = 6;
        $fullCode = '<?php ' . $cleanedCode;

        try {
            $statements = $parser->parse($fullCode);
        } catch (Throwable $exception) {
            throw new UnexpectedValueException(sprintf('Failed to parse code block: %s', $code), 0, $exception);
        }

        $processedLines = [];
        $lastEndPos = $phpTagLength;
        $lastWasAssertion = false;
        $firstAssertionEncountered = false;

        foreach ($statements as $statement) {
            $startPos = $statement->getStartFilePos();
            $endPos = $statement->getEndFilePos();

            if ($startPos > $lastEndPos && !$lastWasAssertion) {
                $between = substr($fullCode, $lastEndPos, $startPos - $lastEndPos);
                $newlineCount = substr_count($between, "\n");
                for ($i = 1; $i < $newlineCount; $i++) {
                    $processedLines[] = '';
                }
            }

            if ($startPos >= 0 && $endPos >= 0) {
                $statementCode = substr($fullCode, $startPos, $endPos - $startPos + 1);
                $restOfCode = substr($fullCode, $endPos + 1);
                if (preg_match('/^(\h*\/\/[^\n]*)/u', $restOfCode, $matches)) {
                    $statementCode .= $matches[1];
                }
            } else {
                $statementCode = $printer->prettyPrint([$statement]);
            }

            $isAssertion = $this->isValidationAssertion($statement);
            if ($isAssertion) {
                $processedLines[] = $statementCode;
                $contextHasClass = $this->contextContainsClass($context);
                $result = $this->executeStatement($statementCode, $context, $printer);

                if ($isFirstCodeBlock && !$firstAssertionEncountered) {
                    // Enforce one-liner for the first assertion in the first code block
                    if (strpos($statementCode, "\n") !== false) {
                        throw new UnexpectedValueException(sprintf(
                            'The first assertion must be a single-line assertion. Statement: %s',
                            trim($statementCode),
                        ));
                    }

                    $validated = false;
                    foreach ($result as $line) {
                        if (trim($line) === '// Validation passes successfully') {
                            $validated = true;
                            break;
                        }
                    }

                    if (!$validated) {
                        throw new UnexpectedValueException(sprintf(
                            'The first assertion in the first code block must validate successfully. Statement: %s',
                            trim($statementCode),
                        ));
                    }

                    $firstAssertionEncountered = true;
                }

                $processedLines = array_merge($processedLines, $result);

                if ($contextHasClass) {
                    $context->exchangeArray([]);
                }
            } else {
                $context->append($printer->prettyPrint([$statement]));
                $processedLines[] = $statementCode;
            }

            $lastEndPos = $endPos + 1;
            $lastWasAssertion = $isAssertion;
        }

        while (count($processedLines) > 0 && trim($processedLines[count($processedLines) - 1]) === '') {
            array_pop($processedLines);
        }

        return $processedLines;
    }

    private function stripOutputComments(string $code): string
    {
        $lines = explode("\n", $code);
        $filteredLines = [];

        foreach ($lines as $line) {
            $trimmed = trim($line);

            if ($trimmed === '// Validation passes successfully') {
                continue;
            }

            if (str_starts_with($trimmed, '// →')) {
                continue;
            }

            $filteredLines[] = $line;
        }

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

        while (count($result) > 0 && trim($result[count($result) - 1]) === '') {
            array_pop($result);
        }

        return implode("\n", $result);
    }

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

        return $this->originatesFromV($expr) || $this->originatesFromVariable($expr);
    }

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

    /** @return array<string, string> */
    private function getReplacements(): array
    {
        $dateTime = new DateTimeImmutable(self::FIXED_DATETIME);

        return [
            '/path/to/file.txt' => 'tests/fixtures/file.txt',
            '/path/to/file' => 'tests/fixtures/file',
            '/path/to/symbolic-link' => 'tests/fixtures/symbolic-link',
            '/path/to/executable' => 'tests/fixtures/executable',
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
