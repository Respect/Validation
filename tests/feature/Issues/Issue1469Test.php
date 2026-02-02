<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1469', catchAll(
    fn() => v::init()
        ->arrayVal()
        ->keySet(
            v::key(
                'order_items',
                v::init()
                    ->arrayVal()
                    ->each(
                        v::keySet(
                            v::key('product_title', v::stringVal()->notBlank()),
                            v::key('quantity', v::intVal()->notBlank()),
                        ),
                    )
                    ->notBlank(),
            ),
        )
        ->assert([
            'order_items' => [
                [
                    'product_title' => 'test',
                    'quantity' => 'test',
                ],
                ['product_title2' => 'test'],
            ],
        ]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.order_items.0.quantity` must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - Each item in `.order_items` must be valid
              - `.order_items.0` validation failed
                - `.order_items.0.quantity` must be an integer
              - `.order_items.1` contains both missing and extra keys
                - `.order_items.1.product_title` must be present
                - `.order_items.1.quantity` must be present
                - `.order_items.1.product_title2` must not be present
            FULL_MESSAGE)
        ->and($messages)->toBe([
            'keySet' => [
                '__root__' => 'Each item in `.order_items` must be valid',
                0 => '`.order_items.0.quantity` must be an integer',
                1 => [
                    '__root__' => '`.order_items.1` contains both missing and extra keys',
                    'product_title' => '`.order_items.1.product_title` must be present',
                    'quantity' => '`.order_items.1.quantity` must be present',
                    'product_title2' => '`.order_items.1.product_title2` must not be present',
                ],
            ],
        ]),
));
