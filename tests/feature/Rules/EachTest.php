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
    ['each' => '`null` must be iterable']
));

test('Empty', expectAll(
    fn() => v::each(v::intType())->assert([]),
    'The value must not be empty',
    '- The value must not be empty',
    ['each' => 'The value must not be empty']
));

test('Default', expectAll(
    fn() => v::each(v::intType())->assert(['a', 'b', 'c']),
    '"a" must be an integer',
    <<<'FULL_MESSAGE'
    - Each item in `["a", "b", "c"]` must be valid
      - "a" must be an integer
      - "b" must be an integer
      - "c" must be an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in `["a", "b", "c"]` must be valid',
        'intType.1' => '"a" must be an integer',
        'intType.2' => '"b" must be an integer',
        'intType.3' => '"c" must be an integer',
    ]
));

test('Inverted', expectAll(
    fn() => v::not(v::each(v::intType()))->assert([1, 2, 3]),
    '1 must not be an integer',
    <<<'FULL_MESSAGE'
    - Each item in `[1, 2, 3]` must be invalid
      - 1 must not be an integer
      - 2 must not be an integer
      - 3 must not be an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in `[1, 2, 3]` must be invalid',
        'intType.1' => '1 must not be an integer',
        'intType.2' => '2 must not be an integer',
        'intType.3' => '3 must not be an integer',
    ]
));

test('With name, non-iterable', expectAll(
    fn() => v::each(v::intType()->setName('Wrapped'))->setName('Wrapper')->assert(null),
    'Wrapped must be iterable',
    '- Wrapped must be iterable',
    ['Wrapped' => 'Wrapped must be iterable']
));

test('With name, empty', expectAll(
    fn() => v::each(v::intType()->setName('Wrapped'))->setName('Wrapper')->assert([]),
    'Wrapped must not be empty',
    '- Wrapped must not be empty',
    ['Wrapped' => 'Wrapped must not be empty']
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
        'intType.1' => 'Wrapped must be an integer',
        'intType.2' => 'Wrapped must be an integer',
        'intType.3' => 'Wrapped must be an integer',
    ]
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
        'intType.1' => 'Wrapped must not be an integer',
        'intType.2' => 'Wrapped must not be an integer',
        'intType.3' => 'Wrapped must not be an integer',
    ]
));

test('With wrapper name, default', expectAll(
    fn() => v::each(v::intType())->setName('Wrapper')->assert(['a', 'b', 'c']),
    'Wrapper must be an integer',
    <<<'FULL_MESSAGE'
    - Each item in Wrapper must be valid
      - Wrapper must be an integer
      - Wrapper must be an integer
      - Wrapper must be an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in Wrapper must be valid',
        'intType.1' => 'Wrapper must be an integer',
        'intType.2' => 'Wrapper must be an integer',
        'intType.3' => 'Wrapper must be an integer',
    ]
));

test('With wrapper name, inverted', expectAll(
    fn() => v::not(v::each(v::intType())->setName('Wrapper'))->setName('Not')->assert([1, 2, 3]),
    'Wrapper must not be an integer',
    <<<'FULL_MESSAGE'
    - Each item in Wrapper must be invalid
      - Wrapper must not be an integer
      - Wrapper must not be an integer
      - Wrapper must not be an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in Wrapper must be invalid',
        'intType.1' => 'Wrapper must not be an integer',
        'intType.2' => 'Wrapper must not be an integer',
        'intType.3' => 'Wrapper must not be an integer',
    ]
));

test('With Not name, inverted', expectAll(
    fn() => v::not(v::each(v::intType()))->setName('Not')->assert([1, 2, 3]),
    'Not must not be an integer',
    <<<'FULL_MESSAGE'
    - Each item in Not must be invalid
      - Not must not be an integer
      - Not must not be an integer
      - Not must not be an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in Not must be invalid',
        'intType.1' => 'Not must not be an integer',
        'intType.2' => 'Not must not be an integer',
        'intType.3' => 'Not must not be an integer',
    ]
));

test('With template, non-iterable', expectAll(
    fn() => v::each(v::intType())->setTemplate('You should have passed an iterable')->assert(null),
    'You should have passed an iterable',
    '- You should have passed an iterable',
    ['each' => 'You should have passed an iterable']
));

test('With template, empty', expectAll(
    fn() => v::each(v::intType())->setTemplate('You should have passed an non-empty')
        ->assert([]),
    'You should have passed an non-empty',
    '- You should have passed an non-empty',
    ['each' => 'You should have passed an non-empty']
));

test('With template, default', expectAll(
    fn() => v::each(v::intType())
        ->setTemplate('All items should have been integers')
        ->assert(['a', 'b', 'c']),
    'All items should have been integers',
    '- All items should have been integers',
    ['each' => 'All items should have been integers']
));

test('with template, inverted', expectAll(
    fn() => v::not(v::each(v::intType()))
        ->setTemplate('All items should not have been integers')
        ->assert([1, 2, 3]),
    'All items should not have been integers',
    '- All items should not have been integers',
    ['notEach' => 'All items should not have been integers']
));

test('With array template, default', expectAll(
    fn() => v::each(v::intType())
        ->setTemplates([
            'each' => [
                '__root__' => 'Here a sequence of items that did not pass the validation',
                'intType.1' => 'First item should have been an integer',
                'intType.2' => 'Second item should have been an integer',
                'intType.3' => 'Third item should have been an integer',
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
        'intType.1' => 'First item should have been an integer',
        'intType.2' => 'Second item should have been an integer',
        'intType.3' => 'Third item should have been an integer',
    ]
));

test('With array template and name, default', expectAll(
    fn() => v::each(v::intType()->setName('Wrapped'))
        ->setName('Wrapper')
        ->setTemplates([
            'Wrapped' => [
                '__root__' => 'Here a sequence of items that did not pass the validation',
                'Wrapped.1' => 'First item should have been an integer',
                'Wrapped.2' => 'Second item should have been an integer',
                'Wrapped.3' => 'Third item should have been an integer',
            ],
        ])
        ->assert(['a', 'b', 'c']),
    'Wrapped must be an integer',
    <<<'FULL_MESSAGE'
    - Each item in Wrapped must be valid
      - Wrapped must be an integer
      - Wrapped must be an integer
      - Wrapped must be an integer
    FULL_MESSAGE,
    [
        '__root__' => 'Each item in Wrapped must be valid',
        'intType.1' => 'Wrapped must be an integer',
        'intType.2' => 'Wrapped must be an integer',
        'intType.3' => 'Wrapped must be an integer',
    ]
));
