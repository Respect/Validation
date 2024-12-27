<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::named(v::stringType(), 'Potato')->assert(12),
    'Potato must be a string',
    '- Potato must be a string',
    ['stringType' => 'Potato must be a string'],
));

test('Inverted', expectAll(
    fn() => v::not(v::named(v::intType(), 'Zucchini'))->assert(12),
    'Zucchini must not be an integer',
    '- Zucchini must not be an integer',
    ['notIntType' => 'Zucchini must not be an integer'],
));

test('Template in Validator', expectAll(
    fn() => v::named(v::stringType(), 'Eggplant')
        ->setName('Mushroom')
        ->assert(12),
    'Eggplant must be a string',
    '- Eggplant must be a string',
    ['stringType' => 'Eggplant must be a string'],
));

test('With bound', expectAll(
    fn() => v::named(v::attributes(), 'Pumpkin')->assert(null),
    'Pumpkin must be an object',
    '- Pumpkin must be an object',
    ['attributes' => 'Pumpkin must be an object'],
));

test('With key that does not exist', expectAll(
    fn() => v::key('vegetable', v::named(v::stringType(), 'Paprika'))->assert([]),
    'Paprika must be present',
    '- Paprika must be present',
    ['vegetable' => 'Paprika must be present'],
));

test('With property that does not exist', expectAll(
    fn() => v::key('vegetable', v::named(v::stringType(), 'Broccoli'))->assert((object) []),
    'Broccoli must be present',
    '- Broccoli must be present',
    ['vegetable' => 'Broccoli must be present'],
));

test('With key that fails validation', expectAll(
    fn() => v::key('vegetable', v::named(v::stringType(), 'Artichoke'))->assert(['vegetable' => 12]),
    'Artichoke must be a string',
    '- Artichoke must be a string',
    ['vegetable' => 'Artichoke must be a string'],
));

test('With nested key that fails validation', expectAll(
    fn() => v::key(
        'vegetables',
        v::named(
            v::create()
                ->key('root', v::stringType())
                ->key('stems', v::stringType())
                ->keyExists('fruits'),
            'Vegetables'
        ),
    )->assert(['vegetables' => ['root' => 12, 'stems' => 12]]),
    'root must be a string',
    <<<'FULL_MESSAGE'
    - Vegetables must pass all the rules
      - root must be a string
      - stems must be a string
      - fruits must be present
    FULL_MESSAGE,
    [
        '__root__' => 'Vegetables must pass all the rules',
        'root' => 'root must be a string',
        'stems' => 'stems must be a string',
        'fruits' => 'fruits must be present',
    ],
));
