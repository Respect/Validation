<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1469', expectAll(
    function (): void {
        v::create()
            ->arrayVal()
            ->keySet(
                v::key(
                    'order_items',
                    v::create()
                        ->arrayVal()
                        ->each(
                            v::keySet(
                                v::key('product_title', v::stringVal()->notEmpty()),
                                v::key('quantity', v::intVal()->notEmpty()),
                            )
                        )
                        ->notEmpty()
                ),
            )
            ->assert([
                'order_items' => [
                    [
                        'product_title' => 'test',
                        'quantity' => 'test',
                    ],
                    [
                        'product_title2' => 'test',
                    ],
                ],
            ]);
    },
    '`.order_items.0.quantity` must be an integer value',
    <<<'FULL_MESSAGE'
    - Each item in `.order_items` must be valid
      - `.0` validation failed
        - `.quantity` must be an integer value
      - `.1` contains both missing and extra keys
        - `.product_title` must be present
        - `.quantity` must be present
        - `.product_title2` must not be present
    FULL_MESSAGE,
    [
        'keySet' => [
            '__root__' => 'Each item in `.order_items` must be valid',
            0 => 'quantity must be an integer value',
            1 => [
                '__root__' => '`.order_items` contains both missing and extra keys',
                'product_title' => '`.product_title` must be present',
                'quantity' => '`.quantity` must be present',
                'product_title2' => '`.product_title2` must not be present',
            ],
        ],
    ],
))->skip(<<<TEST_SKIP
This test is skipped because the issue is not fixed yet.

When changing the path of a `Result` we don't change the path of its children. I took this approach because we don't
want to duplicated `.path1.path1` in the message (`.parent.child`).

However, that means that when one has a rule/result in-between paths (`KeySet` in this case), the children will be
totally unaware of the path of the parent. Although that's partially the intended, it causes problems like these.

I'm not sure how to fix this yet.
TEST_SKIP);
