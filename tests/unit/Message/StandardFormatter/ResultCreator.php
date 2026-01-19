<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\StandardFormatter;

use Respect\Validation\Result;
use Respect\Validation\Test\Builders\ResultBuilder;

trait ResultCreator
{
    private static function singleLevelChildrenMessage(): Result
    {
        return (new ResultBuilder())->id('parent')->template('__parent_original__')
            ->children(
                (new ResultBuilder())->id('1st')->template('__1st_original__')->build(),
                (new ResultBuilder())->id('2nd')->template('__2nd_original__')->build(),
                (new ResultBuilder())->id('3rd')->template('__3rd_original__')->build(),
            )
            ->build();
    }

    private static function multiLevelChildrenWithSingleNestedChildMessage(): Result
    {
        return (new ResultBuilder())->id('parent')->template('__parent_original__')
            ->children(
                (new ResultBuilder())->id('1st')->template('__1st_original__')->build(),
                (new ResultBuilder())->id('2nd')->template('__2nd_original__')
                    ->children(
                        (new ResultBuilder())->id('2nd_1st')->template('__2nd_1st_original__')->build(),
                    )
                    ->build(),
                (new ResultBuilder())->id('3rd')->template('__3rd_original__')->build(),
            )
            ->build();
    }

    private static function multiLevelChildrenWithMultiNestedChildrenMessage(): Result
    {
        return (new ResultBuilder())->id('parent')->template('__parent_original__')
            ->children(
                (new ResultBuilder())->id('1st')->template('__1st_original__')->build(),
                (new ResultBuilder())
                    ->id('2nd')
                    ->template('__2nd_original__')
                    ->children(
                        (new ResultBuilder())->id('2nd_1st')->template('__2nd_1st_original__')->build(),
                        (new ResultBuilder())->id('2nd_2nd')->template('__2nd_2nd_original__')->build(),
                    )
                    ->build(),
                (new ResultBuilder())->id('3rd')->template('__3rd_original__')->build(),
            )
            ->build();
    }

    private static function singleLevelChildrenWithSameId(): Result
    {
        return (new ResultBuilder())->id('parent')->template('__parent_original__')
            ->children(
                (new ResultBuilder())->id('child')->template('__1st_original__')->build(),
                (new ResultBuilder())->id('child')->template('__2nd_original__')->build(),
                (new ResultBuilder())->id('child')->template('__3rd_original__')->build(),
                (new ResultBuilder())->id('child')->template('__4th_original__')->build(),
            )
            ->build();
    }

    private static function multiLevelChildrenWithSiblingsThatHaveOnlyOneChild(): Result
    {
        return (new ResultBuilder())->id('parent')->template('__parent_original__')
            ->children(
                (new ResultBuilder())->id('1st')
                    ->template('__1st_original__')
                    ->children(
                        (new ResultBuilder())
                            ->id('1st_1st')
                            ->template('__1st_1st_original__')
                            ->build(),
                        (new ResultBuilder())
                            ->id('1st_2nd')
                            ->template('__1st_2nd_original__')
                            ->build(),
                    )
                    ->build(),
                (new ResultBuilder())
                    ->id('2nd')
                    ->template('__2nd_original__')
                    ->children(
                        (new ResultBuilder())->id('2nd_1st')->template('__2nd_1st_original__')->build(),
                    )
                    ->build(),
            )
            ->build();
    }

    private static function multiLevelChildrenWithSiblingsThatHaveMoreThanOneChild(): Result
    {
        return (new ResultBuilder())->id('parent')->template('__parent_original__')
            ->children(
                (new ResultBuilder())->id('1st')
                    ->template('__1st_original__')
                    ->children(
                        (new ResultBuilder())->id('1st_1st')->template('__1st_1st_original__')->build(),
                        (new ResultBuilder())->id('1st_2nd')->template('__1st_2nd_original__')->build(),
                    )
                    ->build(),
                (new ResultBuilder())
                    ->id('2nd')
                    ->template('__2nd_original__')
                    ->children(
                        (new ResultBuilder())->id('2nd_1st')->template('__2nd_1st_original__')->build(),
                        (new ResultBuilder())->id('2nd_2nd')->template('__2nd_2nd_original__')->build(),
                    )
                    ->build(),
                (new ResultBuilder())->id('3nd')->template('__3rd_original__')->build(),
            )
            ->build();
    }
}
