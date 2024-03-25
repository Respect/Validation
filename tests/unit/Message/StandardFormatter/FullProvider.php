<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\StandardFormatter;

use Respect\Validation\Result;
use Respect\Validation\Test\Builders\ResultBuilder;

trait FullProvider
{
    use ResultCreator;

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
                <<<MESSAGE
                - __parent_original__
                  - __1st_original__
                  - __2nd_original__
                  - __3rd_original__
                MESSAGE,
            ],
            'with single-level children, with templates' => [
                self::singleLevelChildrenMessage(),
                <<<MESSAGE
                - Parent custom
                  - 1st custom
                  - 2nd custom
                  - 3rd custom
                MESSAGE,
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
                <<<MESSAGE
                - __parent_original__
                  - 1st custom
                  - __2nd_original__
                  - 3rd custom
                MESSAGE,
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
                [
                    'parent' => 'Parent custom',
                ],
            ],
            'with single-nested child, without templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                <<<MESSAGE
                - __parent_original__
                  - __1st_original__
                  - __2nd_1st_original__
                  - __3rd_original__
                MESSAGE,
            ],
            'with single-nested child, with templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                <<<MESSAGE
                - Parent custom
                  - 1st custom
                  - 2nd > 1st custom
                  - 3rd custom
                MESSAGE,
                [
                    'parent' => [
                        '__root__' => 'Parent custom',
                        '1st' => '1st custom',
                        '2nd' => [
                            '2nd_1st' => '2nd > 1st custom',
                        ],
                        '3rd' => '3rd custom',
                    ],
                ],
            ],
            'with single-nested child, with partial templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                <<<MESSAGE
                - Parent custom
                  - 1st custom
                  - __2nd_1st_original__
                  - 3rd custom
                MESSAGE,
                [
                    'parent' => [
                        '__root__' => 'Parent custom',
                        '1st' => '1st custom',
                        '2nd' => [
                            '2nd_2nd' => '2nd > 2nd not shown',
                        ],
                        '3rd' => '3rd custom',
                    ],
                ],
            ],
            'with single-nested child, with overwritten templates' => [
                self::multiLevelChildrenWithSingleNestedChildMessage(),
                <<<MESSAGE
                - Parent custom
                  - 1st custom
                  - 2nd custom
                  - 3rd custom
                MESSAGE,
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
                <<<MESSAGE
                - __parent_original__
                  - __1st_original__
                  - __2nd_original__
                    - __2nd_1st_original__
                    - __2nd_2nd_original__
                  - __3rd_original__
                MESSAGE,
            ],
            'with multi-nested children, with templates' => [
                self::multiLevelChildrenWithMultiNestedChildrenMessage(),
                <<<MESSAGE
                - Parent custom
                  - 1st custom
                  - 2nd custom
                    - 2nd > 1st custom
                    - 2nd > 2nd custom
                  - 3rd custom
                MESSAGE,
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
                <<<MESSAGE
                - Parent custom
                  - 1st custom
                  - __2nd_original__
                    - __2nd_1st_original__
                    - 2nd > 2nd custom
                  - 3rd custom
                MESSAGE,
                [
                    'parent' => [
                        '__root__' => 'Parent custom',
                        '1st' => '1st custom',
                        '2nd' => [
                            '2nd_2nd' => '2nd > 2nd custom',
                        ],
                        '3rd' => '3rd custom',
                    ],
                ],
            ],
            'with multi-nested children, with overwritten templates' => [
                self::multiLevelChildrenWithMultiNestedChildrenMessage(),
                <<<MESSAGE
                - Parent custom
                  - 1st custom
                  - 2nd custom
                  - 3rd custom
                MESSAGE,
                [
                    'parent' => [
                        '__root__' => 'Parent custom',
                        '1st' => '1st custom',
                        '2nd' => '2nd custom',
                        '3rd' => '3rd custom',
                    ],
                ],
            ],
            'with children with the same id, without templates' => [
                self::singleLevelChildrenWithSameId(),
                <<<MESSAGE
                - __parent_original__
                  - __1st_original__
                  - __2nd_original__
                  - __3rd_original__
                MESSAGE,
            ],
            'with children with the same id, with templates' => [
                self::singleLevelChildrenWithSameId(),
                <<<MESSAGE
                - Parent custom
                  - 1st custom
                  - 2nd custom
                  - 3rd custom
                MESSAGE,
                [
                    'parent' => [
                        '__root__' => 'Parent custom',
                        'child.1' => '1st custom',
                        'child.2' => '2nd custom',
                        'child.3' => '3rd custom',
                    ],
                ],
            ],
            'with children with the same id, with partial templates' => [
                self::singleLevelChildrenWithSameId(),
                <<<MESSAGE
                - __parent_original__
                  - 1st custom
                  - 2nd custom
                  - __3rd_original__
                MESSAGE,
                [
                    'parent' => [
                        'child.1' => '1st custom',
                        'child.2' => '2nd custom',
                    ],
                ],
            ],
        ];
    }
}
