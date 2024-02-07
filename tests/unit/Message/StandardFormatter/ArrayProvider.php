<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\StandardFormatter;

use Respect\Validation\Result;
use Respect\Validation\Test\Builders\ResultBuilder;

trait ArrayProvider
{
    use ResultCreator;

    /** @return array<string, array{0: Result, 1: array<string, mixed>, 2?: array<string, mixed>}> */
    public static function provideForArray(): array
    {
        return [
            'without children, without templates' => [
                (new ResultBuilder())->id('only')->template('__parent_original__')->build(),
                ['only' => '__parent_original__'],
            ],
            'without children, with templates' => [
                (new ResultBuilder())->id('only')->build(),
                ['only' => 'Custom template'],
                ['only' => 'Custom template'],
            ],
            'with single-level children, without templates' => [
                self::singleLevelChildrenMessage(),
                [
                    '1st' => '__1st_original__',
                    '2nd' => '__2nd_original__',
                    '3rd' => '__3rd_original__',
                ],
            ],
            'with single-level children, with templates' => [
                self::singleLevelChildrenMessage(),
                [
                    '1st' => '1st custom',
                    '2nd' => '2nd custom',
                    '3rd' => '3rd custom',
                ],
                [
                    '__self__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => '2nd custom',
                    '3rd' => '3rd custom',
                ],
            ],
            'with single-level children, with partial templates' => [
                self::singleLevelChildrenMessage(),
                [

                    '1st' => '1st custom',
                    '2nd' => '__2nd_original__',
                    '3rd' => '3rd custom',
                ],
                [
                    '1st' => '1st custom',
                    '3rd' => '3rd custom',
                ],
            ],
            'with single-level children, with overwritten template' => [
                self::singleLevelChildrenMessage(),
                ['parent' => 'Parent custom'],
                ['parent' => 'Parent custom'],
            ],
            'with single-nested child, without templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                [

                    '1st' => '__1st_original__',
                    '2nd' => '__2nd_1st_original__',
                    '3rd' => '__3rd_original__',
                ],
            ],
            'with single-nested child, with templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                [
                    '1st' => '1st custom',
                    '2nd' => '2nd > 1st custom',
                    '3rd' => '3rd custom',
                ],
                [
                    '__self__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => [
                        '2nd_1st' => '2nd > 1st custom',
                    ],
                    '3rd' => '3rd custom',
                ],
            ],
            'with single-nested child, with partial templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                [
                    '1st' => '1st custom',
                    '2nd' => '__2nd_1st_original__',
                    '3rd' => '3rd custom',
                ],
                [
                    '__self__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => [
                        '2nd_2nd' => '2nd > 2nd not shown',
                    ],
                    '3rd' => '3rd custom',
                ],
            ],
            'with single-nested child, with overwritten templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                [
                    '1st' => '1st custom',
                    '2nd' => '2nd custom',
                    '3rd' => '3rd custom',
                ],
                [
                    '1st' => '1st custom',
                    '2nd' => '2nd custom',
                    '3rd' => '3rd custom',
                ],
            ],
            'with multi-nested children, without templates' => [
                self::multiLevelChildrenWithMultiNestedChildrenMessage(),
                [
                    '1st' => '__1st_original__',
                    '2nd' => [
                        '2nd_1st' => '__2nd_1st_original__',
                        '2nd_2nd' => '__2nd_2nd_original__',
                    ],
                    '3rd' => '__3rd_original__',
                ],
            ],
            'with multi-nested children, with templates' => [
                self::multiLevelChildrenWithMultiNestedChildrenMessage(),
                [
                    '1st' => '1st custom',
                    '2nd' => [
                        '2nd_1st' => '2nd > 1st custom',
                        '2nd_2nd' => '2nd > 2nd custom',
                    ],
                    '3rd' => '3rd custom',
                ],
                [
                    '1st' => '1st custom',
                    '2nd' => [
                        '2nd_1st' => '2nd > 1st custom',
                        '2nd_2nd' => '2nd > 2nd custom',
                    ],
                    '3rd' => '3rd custom',
                ],
            ],
            'with multi-nested children, with partial templates' => [
                self::multiLevelChildrenWithMultiNestedChildrenMessage(),
                [
                    '1st' => '1st custom',
                    '2nd' => [
                        '2nd_1st' => '__2nd_1st_original__',
                        '2nd_2nd' => '2nd > 2nd custom',
                    ],
                    '3rd' => '3rd custom',
                ],
                [
                    'parent' => [
                        '__self__' => 'Parent custom',
                        '1st' => '1st custom',
                        '2nd' => [
                            '2nd_2nd' => '2nd > 2nd custom',
                        ],
                        '3rd' => '3rd custom',
                    ],
                ],
            ],
            'with children with the same id, without templates' => [
                self::singleLevelChildrenWithSameId(),
                [
                    'child.1' => '__1st_original__',
                    'child.2' => '__2nd_original__',
                    'child.3' => '__3rd_original__',
                ],
            ],
            'with children with the same id, with templates' => [
                self::singleLevelChildrenWithSameId(),
                [
                    'child.1' => '1st custom',
                    'child.2' => '2nd custom',
                    'child.3' => '3rd custom',
                ],
                [
                    'child.1' => '1st custom',
                    'child.2' => '2nd custom',
                    'child.3' => '3rd custom',
                ],
            ],
            'with children with the same id, with partial templates' => [
                self::singleLevelChildrenWithSameId(),
                [
                    'child.1' => '1st custom',
                    'child.2' => '2nd custom',
                    'child.3' => '__3rd_original__',
                ],
                [
                    'child.1' => '1st custom',
                    'child.2' => '2nd custom',
                ],
            ],
        ];
    }
}
