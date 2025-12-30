<?php

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Message\StandardFormatter\ResultCreator;
use Respect\Validation\Result;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\Message\TestingMessageRenderer;
use Respect\Validation\Test\TestCase;

#[CoversClass(NestedListStringFormatter::class)]
final class NestedListStringFormatterTest extends TestCase
{
    use ResultCreator;

    /** @param array<string, mixed> $templates */
    #[Test]
    #[DataProvider('provideForFull')]
    public function itShouldFormatFullMessage(Result $result, string $expected, array $templates = []): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new NestedListStringFormatter();

        self::assertSame($expected, $formatter->format($result, $renderer, $templates));
    }

    /** @return array<string, array{0: Result, 1: string, 2?: array<string, mixed>}> */
    public static function provideForFull(): array
    {
        return [
            'without children' => [
                (new ResultBuilder())->template('Message')->build(),
                '- Message',
            ],
            'with single-level children' => [
                self::singleLevelChildrenMessage(),
                <<<'FULL_MESSAGE'
                - __parent_original__
                  - __1st_original__
                  - __2nd_original__
                  - __3rd_original__
                FULL_MESSAGE,
            ],
            'with single-nested child' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                <<<'FULL_MESSAGE'
                - __parent_original__
                  - __1st_original__
                  - __2nd_original__
                    - __2nd_1st_original__
                  - __3rd_original__
                FULL_MESSAGE,
            ],
            'with multi-nested children' => [
                self::multiLevelChildrenWithMultiNestedChildrenMessage(),
                <<<'FULL_MESSAGE'
                - __parent_original__
                  - __1st_original__
                  - __2nd_original__
                    - __2nd_1st_original__
                    - __2nd_2nd_original__
                  - __3rd_original__
                FULL_MESSAGE,
            ],
            'with siblings that dot not have only one child' => [
                self::multiLevelChildrenWithSiblingsThatHaveOnlyOneChild(),
                <<<'FULL_MESSAGE'
                - __parent_original__
                  - __1st_original__
                    - __1st_1st_original__
                    - __1st_2nd_original__
                  - __2nd_original__
                    - __2nd_1st_original__
                FULL_MESSAGE,
            ],
            'with siblings that dot not have more than one child' => [
                self::multiLevelChildrenWithSiblingsThatHaveMoreThanOneChild(),
                <<<'FULL_MESSAGE'
                - __parent_original__
                  - __1st_original__
                    - __1st_1st_original__
                    - __1st_2nd_original__
                  - __2nd_original__
                    - __2nd_1st_original__
                    - __2nd_2nd_original__
                  - __3rd_original__
                FULL_MESSAGE,
            ],
        ];
    }
}
