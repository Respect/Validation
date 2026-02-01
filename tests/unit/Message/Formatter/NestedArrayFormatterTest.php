<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Message\StandardFormatter\ResultCreator;
use Respect\Validation\Path;
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

    /** @return array<string, array{0: Result, 1: array<int|string, mixed>, 2?: array<int|string, mixed>}> */
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
            'with string key collision' => [
                (new ResultBuilder())->id('root')->template('root_msg')
                    ->children(
                        (new ResultBuilder())->id('c1')->template('msg1')->path(new Path('foo'))->build(),
                        (new ResultBuilder())->id('c2')->template('msg2')->path(new Path('foo'))->build(),
                    )->build(),
                [
                    'foo' => ['msg1', 'msg2'],
                ],
            ],
            'with numeric key collision (list)' => [
                (new ResultBuilder())->id('root')->template('root_msg')
                    ->children(
                        (new ResultBuilder())->id('c1')->template('msg1')->path(new Path(0))->build(),
                        (new ResultBuilder())->id('c2')->template('msg2')->path(new Path(0))->build(),
                    )->build(),
                [
                    '__root__' => 'root_msg',
                    0 => 'msg1',
                    1 => 'msg2',
                ],
            ],
            'with mixed keys replacement' => [
                (new ResultBuilder())->id('root')->template('root_msg')
                    ->children(
                        (new ResultBuilder())->id('c1')->template('msg1')->path(new Path('foo'))->build(),
                        (new ResultBuilder())->id('c2')->template('msg2')->path(new Path(0))->build(),
                    )->build(),
                [
                    '__root__' => 'root_msg',
                    'foo' => 'msg1',
                    'c2' => 'msg2',
                ],
            ],
            'with mixed keys and ID collision' => [
                (new ResultBuilder())->id('root')->template('root_msg')
                    ->children(
                        (new ResultBuilder())->id('c1')->template('msg1')->path(new Path('foo'))->build(),
                        (new ResultBuilder())->id('sameId')->template('msg2')->path(new Path(0))->build(),
                        (new ResultBuilder())->id('sameId')->template('msg3')->path(new Path(1))->build(),
                    )->build(),
                [
                    '__root__' => 'root_msg',
                    'foo' => 'msg1',
                    'sameId' => ['msg2', 'msg3'],
                ],
            ],
            'with id collision and nested children' => [
                (new ResultBuilder())->id('root')->template('root_msg')
                    ->children(
                        (new ResultBuilder())->id('sameId')->template('c1_root')
                            ->children(
                                (new ResultBuilder())->template('msg2')->path(new Path(0))->build(),
                                (new ResultBuilder())->template('msg3')->path(new Path(1))->build(),
                            )->build(),
                        (new ResultBuilder())->id('sameId')->template('c2_root')
                            ->children(
                                (new ResultBuilder())->template('msg4')->path(new Path(0))->build(),
                                (new ResultBuilder())->template('msg5')->path(new Path(1))->build(),
                            )->build(),
                    )->build(),
                [
                    '__root__' => 'root_msg',
                    0 => [
                        '__root__' => 'c1_root',
                        0 => 'msg2',
                        1 => 'msg3',
                    ],
                    1 => [
                        '__root__' => 'c2_root',
                        0 => 'msg4',
                        1 => 'msg5',
                    ],
                ],
            ],
            'with string path collision and nested children' => [
                (new ResultBuilder())->id('root')->template('root_msg')
                    ->children(
                        (new ResultBuilder())->id('c1')->template('c1_root')
                            ->children(
                                (new ResultBuilder())->template('msg2')->path(new Path(0))->build(),
                                (new ResultBuilder())->template('msg3')->path(new Path(1))->build(),
                            )->path(new Path('foo'))->build(),
                        (new ResultBuilder())->id('c2')->template('c2_root')
                            ->children(
                                (new ResultBuilder())->template('msg4')->path(new Path(0))->build(),
                                (new ResultBuilder())->template('msg5')->path(new Path(1))->build(),
                            )->path(new Path('foo'))->build(),
                    )->build(),
                [
                    'foo' => [
                        0 => [
                            '__root__' => 'c1_root',
                            0 => 'msg2',
                            1 => 'msg3',
                        ],
                        1 => [
                            '__root__' => 'c2_root',
                            0 => 'msg4',
                            1 => 'msg5',
                        ],
                    ],
                ],
            ],
            'with pure numeric keys' => [
                (new ResultBuilder())->id('root')->template('root_msg')
                    ->children(
                        (new ResultBuilder())->id('c1')->template('msg1')->path(new Path(10))->build(),
                        (new ResultBuilder())->id('c2')->template('msg2')->path(new Path(20))->build(),
                    )->build(),
                [
                    '__root__' => 'root_msg',
                    0 => 'msg1',
                    1 => 'msg2',
                ],
            ],
        ];
    }
}
