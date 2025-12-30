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

#[CoversClass(NestedArrayFormatter::class)]
final class NestedArrayFormatterTest extends TestCase
{
    use ResultCreator;

    /**
     * @param array<string, mixed> $expected
     * @param array<string, mixed> $templates
     */
    #[Test]
    #[DataProvider('provideForArray')]
    public function itShouldFormatArrayMessage(Result $result, array $expected, array $templates = []): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new NestedArrayFormatter();

        self::assertSame($expected, $formatter->format($result, $renderer, $templates));
    }

    /** @return array<string, array{0: Result, 1: array<string, mixed>, 2?: array<string, mixed>}> */
    public static function provideForArray(): array
    {
        return [
            'without children' => [
                (new ResultBuilder())->id('only')->template('__parent_original__')->build(),
                ['only' => '__parent_original__'],
            ],
            'with single-level children' => [
                self::singleLevelChildrenMessage(),
                [
                    '__root__' => '__parent_original__',
                    '1st' => '__1st_original__',
                    '2nd' => '__2nd_original__',
                    '3rd' => '__3rd_original__',
                ],
            ],
            'with single-nested child' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                [
                    '__root__' => '__parent_original__',
                    '1st' => '__1st_original__',
                    '2nd' => '__2nd_1st_original__',
                    '3rd' => '__3rd_original__',
                ],
            ],
            'with multi-nested children' => [
                self::multiLevelChildrenWithMultiNestedChildrenMessage(),
                [
                    '__root__' => '__parent_original__',
                    '1st' => '__1st_original__',
                    '2nd' => [
                        '__root__' => '__2nd_original__',
                        '2nd_1st' => '__2nd_1st_original__',
                        '2nd_2nd' => '__2nd_2nd_original__',
                    ],
                    '3rd' => '__3rd_original__',
                ],
            ],
        ];
    }
}
