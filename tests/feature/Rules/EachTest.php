<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Non-iterable', expectAll(
    fn() => v::each(v::intType())->assert(null),
    '`null` must be iterable',
    '- `null` must be iterable',
    ['each' => '`null` must be iterable'],
));

test('Empty', expectAll(
    fn() => v::each(v::intType())->assert([]),
    '`[]` must not be empty',
    '- `[]` must not be empty',
    ['each' => '`[]` must not be empty'],
));

test('Default', expectAll(
    fn() => v::each(v::intType())->assert(['a', 'b', 'c']),
    '`.0` must be an integer',
    <<<'FULL_MESSAGE'
    - Each item in `["a", "b", "c"]` must be valid
      - `.0` must be an integer
      - `.1` must be an integer
      - `.2` must be an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in `["a", "b", "c"]` must be valid',
        0 => '`.0` must be an integer',
        1 => '`.1` must be an integer',
        2 => '`.2` must be an integer',
    ],
));

test('Inverted', expectAll(
    fn() => v::not(v::each(v::intType()))->assert([1, 2, 3]),
    '`.0` must not be an integer',
    <<<'FULL_MESSAGE'
    - Each item in `[1, 2, 3]` must be invalid
      - `.0` must not be an integer
      - `.1` must not be an integer
      - `.2` must not be an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in `[1, 2, 3]` must be invalid',
        0 => '`.0` must not be an integer',
        1 => '`.1` must not be an integer',
        2 => '`.2` must not be an integer',
    ],
));

test('With name, non-iterable', expectAll(
    fn() => v::each(v::intType()->setName('Wrapped'))->assert(null),
    'Wrapped must be iterable',
    '- Wrapped must be iterable',
    ['each' => 'Wrapped must be iterable'],
));

test('With name, empty', expectAll(
    fn() => v::each(v::intType()->setName('Wrapped'))->assert([]),
    'Wrapped must not be empty',
    '- Wrapped must not be empty',
    ['each' => 'Wrapped must not be empty'],
));

test('With name, default', expectAll(
    fn() => v::each(v::intType()->setName('Wrapped'))->setName('Wrapper')->assert(['a', 'b', 'c']),
    'Wrapped must be an integer',
    <<<'FULL_MESSAGE'
    - Each item in Wrapped must be valid
      - Wrapped must be an integer
      - Wrapped must be an integer
      - Wrapped must be an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in Wrapped must be valid',
        0 => 'Wrapped must be an integer',
        1 => 'Wrapped must be an integer',
        2 => 'Wrapped must be an integer',
    ],
));

test('With name, inverted', expectAll(
    fn() => v::not(v::each(v::intType()->setName('Wrapped'))->setName('Wrapper'))->setName('Not')->assert([1, 2, 3]),
    'Wrapped must not be an integer',
    <<<'FULL_MESSAGE'
    - Each item in Wrapped must be invalid
      - Wrapped must not be an integer
      - Wrapped must not be an integer
      - Wrapped must not be an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in Wrapped must be invalid',
        0 => 'Wrapped must not be an integer',
        1 => 'Wrapped must not be an integer',
        2 => 'Wrapped must not be an integer',
    ],
));

test('With wrapper name, default', expectAll(
    fn() => v::each(v::intType())->setName('Wrapper')->assert(['a', 'b', 'c']),
    '`.0` must be an integer',
    <<<'FULL_MESSAGE'
    - Each item in Wrapper must be valid
      - `.0` must be an integer
      - `.1` must be an integer
      - `.2` must be an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in Wrapper must be valid',
        0 => '`.0` must be an integer',
        1 => '`.1` must be an integer',
        2 => '`.2` must be an integer',
    ],
));

test('With wrapper name, inverted', expectAll(
    fn() => v::not(v::each(v::intType())->setName('Wrapper'))->setName('Not')->assert([1, 2, 3]),
    '`.0` must not be an integer',
    <<<'FULL_MESSAGE'
    - Each item in Wrapper must be invalid
      - `.0` must not be an integer
      - `.1` must not be an integer
      - `.2` must not be an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in Wrapper must be invalid',
        0 => '`.0` must not be an integer',
        1 => '`.1` must not be an integer',
        2 => '`.2` must not be an integer',
    ],
));

test('With Not name, inverted', expectAll(
    fn() => v::not(v::each(v::intType()))->setName('Not')->assert([1, 2, 3]),
    '`.0` must not be an integer',
    <<<'FULL_MESSAGE'
    - Each item in Not must be invalid
      - `.0` must not be an integer
      - `.1` must not be an integer
      - `.2` must not be an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in Not must be invalid',
        0 => '`.0` must not be an integer',
        1 => '`.1` must not be an integer',
        2 => '`.2` must not be an integer',
    ],
));

test('With template, non-iterable', expectAll(
    fn() => v::each(v::intType())->setTemplate('You should have passed an iterable')->assert(null),
    'You should have passed an iterable',
    '- You should have passed an iterable',
    ['each' => 'You should have passed an iterable'],
));

test('With template, empty', expectAll(
    fn() => v::each(v::intType())->setTemplate('You should have passed an non-empty')
        ->assert([]),
    'You should have passed an non-empty',
    '- You should have passed an non-empty',
    ['each' => 'You should have passed an non-empty'],
));

test('With template, default', expectAll(
    fn() => v::each(v::intType())
        ->setTemplate('All items should have been integers')
        ->assert(['a', 'b', 'c']),
    'All items should have been integers',
    '- All items should have been integers',
    ['each' => 'All items should have been integers'],
));

test('with template, inverted', expectAll(
    fn() => v::not(v::each(v::intType()))
        ->setTemplate('All items should not have been integers')
        ->assert([1, 2, 3]),
    'All items should not have been integers',
    '- All items should not have been integers',
    ['notEach' => 'All items should not have been integers'],
));

test('With array template, default', expectAll(
    fn() => v::each(v::intType())
        ->setTemplates([
            'each' => [
                '__root__' => 'Here a sequence of items that did not pass the validation',
                0 => 'First item should have been an integer',
                1 => 'Second item should have been an integer',
                2 => 'Third item should have been an integer',
            ],
        ])
        ->assert(['a', 'b', 'c']),
    'First item should have been an integer',
    <<<'FULL_MESSAGE'
    - Here a sequence of items that did not pass the validation
      - First item should have been an integer
      - Second item should have been an integer
      - Third item should have been an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Here a sequence of items that did not pass the validation',
        0 => 'First item should have been an integer',
        1 => 'Second item should have been an integer',
        2 => 'Third item should have been an integer',
    ],
));

test('With array template and name, default', expectAll(
    fn() => v::each(v::intType()->setName('Wrapped'))
        ->setName('Wrapper')
        ->setTemplates([
            'Wrapped' => [
                '__root__' => 'Here a sequence of items that did not pass the validation',
                0 => 'First item should have been an integer',
                1 => 'Second item should have been an integer',
                2 => 'Third item should have been an integer',
            ],
        ])
        ->assert(['a', 'b', 'c']),
    'First item should have been an integer',
    <<<'FULL_MESSAGE'
    - Here a sequence of items that did not pass the validation
      - First item should have been an integer
      - Second item should have been an integer
      - Third item should have been an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Here a sequence of items that did not pass the validation',
        0 => 'First item should have been an integer',
        1 => 'Second item should have been an integer',
        2 => 'Third item should have been an integer',
    ],
));

test('Chained wrapped rule', expectAll(
    fn() => v::each(v::between(5, 7)->odd())->assert([2, 4]),
    '`.0` must be between 5 and 7',
    <<<'FULL_MESSAGE'
    - Each item in `[2, 4]` must be valid
      - `.0` must pass all the rules
        - `.0` must be between 5 and 7
        - `.0` must be an odd number
      - `.1` must pass all the rules
        - `.1` must be between 5 and 7
        - `.1` must be an odd number
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in `[2, 4]` must be valid',
        0 => [
            '__root__' => '`.0` must pass all the rules',
            'between' => '`.0` must be between 5 and 7',
            'odd' => '`.0` must be an odd number',
        ],
        1 => [
            '__root__' => '`.1` must pass all the rules',
            'between' => '`.1` must be between 5 and 7',
            'odd' => '`.1` must be an odd number',
        ],
    ],
));

test('Multiple nested rules', expectAll(
    fn() => v::each(v::arrayType()->key('my_int', v::intType()->odd()))->assert([['not_int' => 'wrong'], ['my_int' => 2], 'not an array']),
    '`.0.my_int` must be present',
    <<<'FULL_MESSAGE'
    - Each item in `[["not_int": "wrong"], ["my_int": 2], "not an array"]` must be valid
      - `.0` must pass the rules
        - `.my_int` must be present
      - `.1` must pass the rules
        - `.my_int` must be an odd number
      - `.2` must pass all the rules
        - `.2` must be an array
        - `.my_int` must be present
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in `[["not_int": "wrong"], ["my_int": 2], "not an array"]` must be valid',
        0 => '`.my_int` must be present',
        1 => '`.my_int` must be an odd number',
        2 => [
            '__root__' => '`.2` must pass all the rules',
            'arrayType' => '`.2` must be an array',
            'my_int' => '`.my_int` must be present',
        ],
    ],
));
