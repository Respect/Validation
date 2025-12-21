<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Message\StandardFormatter\ResultCreator;
use Respect\Validation\Result;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\Message\TestingMessageRenderer;
use Respect\Validation\Test\TestCase;
use stdClass;

use function Respect\Stringifier\stringify;
use function sprintf;

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
        $formatter = new NestedListStringFormatter(new TemplateResolver());

        self::assertSame($expected, $formatter->format($result, $renderer, $templates));
    }

    #[Test]
    public function itShouldThrowAnExceptionWhenTryingToFormatAndTemplateIsInvalid(): void
    {
        $renderer = new TestingMessageRenderer();
        $formatter = new NestedListStringFormatter(new TemplateResolver());
        $result = (new ResultBuilder())->id('foo')->build();

        $template = new stdClass();

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage(sprintf('Template for "foo" must be a string, %s given', stringify($template)));

        $formatter->format($result, $renderer, ['foo' => $template]);
    }

    /** @return array<string, array{0: Result, 1: string, 2?: array<string, mixed>}> */
    public static function provideForFull(): array
    {
        return [
            'without children, without templates' => [
                (new ResultBuilder())->template('Message')->build(),
                '- Message',
            ],
            'without children, with templates' => [
                (new ResultBuilder())->id('foo')->build(),
                '- Custom message',
                ['foo' => 'Custom message'],
            ],
            'with single-level children, without templates' => [
                self::singleLevelChildrenMessage(),
                <<<'FULL_MESSAGE'
                - __parent_original__
                  - __1st_original__
                  - __2nd_original__
                  - __3rd_original__
                FULL_MESSAGE,
            ],
            'with single-level children, with templates' => [
                self::singleLevelChildrenMessage(),
                <<<'FULL_MESSAGE'
                - Parent custom
                  - 1st custom
                  - 2nd custom
                  - 3rd custom
                FULL_MESSAGE,
                [
                    'parent' => [
                        '__root__' => 'Parent custom',
                        '1st' => '1st custom',
                        '2nd' => '2nd custom',
                        '3rd' => '3rd custom',
                    ],
                ],
            ],
            'with single-level children, with partial templates' => [
                self::singleLevelChildrenMessage(),
                <<<'FULL_MESSAGE'
                - __parent_original__
                  - 1st custom
                  - __2nd_original__
                  - 3rd custom
                FULL_MESSAGE,
                [
                    'parent' => [
                        '1st' => '1st custom',
                        '3rd' => '3rd custom',
                    ],
                ],
            ],
            'with single-level children, with overwritten template' => [
                self::singleLevelChildrenMessage(),
                '- Parent custom',
                ['parent' => 'Parent custom'],
            ],
            'with single-nested child, without templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                <<<'FULL_MESSAGE'
                - __parent_original__
                  - __1st_original__
                  - __2nd_original__
                    - __2nd_1st_original__
                  - __3rd_original__
                FULL_MESSAGE,
            ],
            'with single-nested child, with templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                <<<'FULL_MESSAGE'
                - Parent custom
                  - 1st custom
                  - 2nd custom
                    - 2nd > 1st custom
                  - 3rd custom
                FULL_MESSAGE,
                [
                    'parent' => [
                        '__root__' => 'Parent custom',
                        '1st' => '1st custom',
                        '2nd' => [
                            '__root__' => '2nd custom',
                            '2nd_1st' => '2nd > 1st custom',
                        ],
                        '3rd' => '3rd custom',
                    ],
                ],
            ],
            'with single-nested child, with partial templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                <<<'FULL_MESSAGE'
                - Parent custom
                  - 1st custom
                  - __2nd_original__
                    - __2nd_1st_original__
                  - 3rd custom
                FULL_MESSAGE,
                [
                    'parent' => [
                        '__root__' => 'Parent custom',
                        '1st' => '1st custom',
                        '2nd' => ['2nd_2nd' => '2nd > 2nd not shown'],
                        '3rd' => '3rd custom',
                    ],
                ],
            ],
            'with single-nested child, with overwritten templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                <<<'FULL_MESSAGE'
                - Parent custom
                  - 1st custom
                  - 2nd custom
                  - 3rd custom
                FULL_MESSAGE,
                [
                    'parent' => [
                        '__root__' => 'Parent custom',
                        '1st' => '1st custom',
                        '2nd' => '2nd custom',
                        '3rd' => '3rd custom',
                    ],
                ],
            ],
            'with multi-nested children, without templates' => [
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
            'with multi-nested children, with templates' => [
                self::multiLevelChildrenWithMultiNestedChildrenMessage(),
                <<<'FULL_MESSAGE'
                - Parent custom
                  - 1st custom
                  - 2nd custom
                    - 2nd > 1st custom
                    - 2nd > 2nd custom
                  - 3rd custom
                FULL_MESSAGE,
                [
                    'parent' => [
                        '__root__' => 'Parent custom',
                        '1st' => '1st custom',
                        '2nd' => [
                            '__root__' => '2nd custom',
                            '2nd_1st' => '2nd > 1st custom',
                            '2nd_2nd' => '2nd > 2nd custom',
                        ],
                        '3rd' => '3rd custom',
                    ],
                ],
            ],
            'with multi-nested children, with partial templates' => [
                self::multiLevelChildrenWithMultiNestedChildrenMessage(),
                <<<'FULL_MESSAGE'
                - Parent custom
                  - 1st custom
                  - __2nd_original__
                    - __2nd_1st_original__
                    - 2nd > 2nd custom
                  - 3rd custom
                FULL_MESSAGE,
                [
                    'parent' => [
                        '__root__' => 'Parent custom',
                        '1st' => '1st custom',
                        '2nd' => ['2nd_2nd' => '2nd > 2nd custom'],
                        '3rd' => '3rd custom',
                    ],
                ],
            ],
            'with multi-nested children, with overwritten templates' => [
                self::multiLevelChildrenWithMultiNestedChildrenMessage(),
                <<<'FULL_MESSAGE'
                - Parent custom
                  - 1st custom
                  - 2nd custom
                  - 3rd custom
                FULL_MESSAGE,
                [
                    'parent' => [
                        '__root__' => 'Parent custom',
                        '1st' => '1st custom',
                        '2nd' => '2nd custom',
                        '3rd' => '3rd custom',
                    ],
                ],
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
            'with siblings that dot not have only one child, with partial templates' => [
                self::multiLevelChildrenWithSiblingsThatHaveOnlyOneChild(),
                <<<'FULL_MESSAGE'
                - __parent_original__
                  - 1st custom
                  - 2nd custom
                    - 2nd > 1st custom
                FULL_MESSAGE,
                [
                    'parent' => [
                        '1st' => '1st custom',
                        '2nd' => [
                            '__root__' => '2nd custom',
                            '2nd_1st' => '2nd > 1st custom',
                        ],
                    ],
                ],
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
