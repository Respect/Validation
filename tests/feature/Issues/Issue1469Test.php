<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1469', expectAll(
    function (): void {
        $data = [
            'order_items' => [
                [
                    'product_title' => 'test',
                    'quantity' => 'test',
                ],
                [
                    'product_title2' => 'test',
                ],
            ],
        ];

        v::arrayVal()->keySet(
            v::key('order_items', v::arrayVal()->each(v::keySet(
                v::key('product_title', v::stringVal()->notEmpty()),
                v::key('quantity', v::intVal()->notEmpty()),
            ))->notEmpty()),
        )->assert($data);
    },
    'quantity must be an integer value',
    <<<'FULL_MESSAGE'
    - Each item in order_items must be valid
      - order_items validation failed
        - quantity must be an integer value
      - order_items contains both missing and extra keys
        - product_title must be present
        - quantity must be present
        - product_title2 must not be present
    FULL_MESSAGE,
    [
        'keySet' => [
            '__root__' => 'Each item in order_items must be valid',
            'keySet.1' => 'quantity must be an integer value',
            'keySet.2' => [
                '__root__' => 'order_items contains both missing and extra keys',
                'product_title' => 'product_title must be present',
                'quantity' => 'quantity must be present',
                'product_title2' => 'product_title2 must not be present',
            ],
        ],
    ]
));
