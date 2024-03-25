<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\StandardFormatter;

use Respect\Validation\Result;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Validatable;

trait MainProvider
{
    use ResultCreator;

    /** @return array<string, array{0: Result, 1: string, 2?: array<string, mixed>}> */
    public static function provideForMain(): array
    {
        return [
            'without children, without templates' => [
                (new ResultBuilder())->build(),
                Validatable::TEMPLATE_STANDARD,
            ],
            'without children, with templates' => [
                (new ResultBuilder())->build(),
                'This is a new template',
                [(new ResultBuilder())->build()->id => 'This is a new template'],
            ],
            'with children, without templates' => [
                (new ResultBuilder())
                    ->id('parent')->id('parent')->template('__parent_original__')
                    ->children(
                        (new ResultBuilder())->id('1st')->template('__1st_original__')->build(),
                        (new ResultBuilder())->id('1st')->template('__2nd_original__')->build(),
                    )
                    ->build(),
                '__1st_original__',
            ],
            'with children, with templates' => [
                (new ResultBuilder())->id('parent')->template('__parent_original__')
                    ->children(
                        (new ResultBuilder())->id('1st')->template('__1st_original__')->build(),
                        (new ResultBuilder())->id('1st')->template('__2nd_original__')->build(),
                    )
                    ->build(),
                'Parent custom',
                [
                    '__self__' => 'Parent custom',
                    '1st' => '1st custom',
                    '2nd' => '2nd custom',
                ],
            ],
            'with nested children, without templates' => [
                (new ResultBuilder())->id('parent')->template('__parent_original__')
                    ->children(
                        (new ResultBuilder())->id('1st')->template('__1st_original__')
                            ->children(
                                (new ResultBuilder())->id('1st_1st')->template('__1st_1st_original__')->build(),
                                (new ResultBuilder())->id('1st_2nd')->template('__1st_2nd_original__')->build(),
                            )
                            ->build(),
                        (new ResultBuilder())->id('1st')->template('__2nd_original__')->build(),
                    )
                    ->build(),
                '__1st_1st_original__',
            ],
        ];
    }
}
