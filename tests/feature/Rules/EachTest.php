<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Non-iterable', catchAll(
    fn() => v::each(v::intType())->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`null` must be iterable')
        ->and($fullMessage)->toBe('- `null` must be iterable')
        ->and($messages)->toBe(['each' => '`null` must be iterable']),
));

test('Empty', catchAll(
    fn() => v::each(v::intType())->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The length of `[]` must be greater than 0')
        ->and($fullMessage)->toBe('- The length of `[]` must be greater than 0')
        ->and($messages)->toBe(['each' => 'The length of `[]` must be greater than 0']),
));

test('Default', catchAll(
    fn() => v::each(v::intType())->assert(['a', 'b', 'c']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.0` must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each item in `["a", "b", "c"]` must be valid
          - `.0` must be an integer
          - `.1` must be an integer
          - `.2` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each item in `["a", "b", "c"]` must be valid',
            0 => '`.0` must be an integer',
            1 => '`.1` must be an integer',
            2 => '`.2` must be an integer',
        ]),
));

test('Inverted', catchAll(
    fn() => v::not(v::each(v::intType()))->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.0` must not be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each item in `[1, 2, 3]` must be invalid
          - `.0` must not be an integer
          - `.1` must not be an integer
          - `.2` must not be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each item in `[1, 2, 3]` must be invalid',
            0 => '`.0` must not be an integer',
            1 => '`.1` must not be an integer',
            2 => '`.2` must not be an integer',
        ]),
));

test('With name, non-iterable', catchAll(
    fn() => v::each(v::named(v::intType(), 'Wrapped'))->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapped must be iterable')
        ->and($fullMessage)->toBe('- Wrapped must be iterable')
        ->and($messages)->toBe(['each' => 'Wrapped must be iterable']),
));

test('With name, empty', catchAll(
    fn() => v::each(v::named(v::intType(), 'Wrapped'))->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The length of Wrapped must be greater than 0')
        ->and($fullMessage)->toBe('- The length of Wrapped must be greater than 0')
        ->and($messages)->toBe(['each' => 'The length of Wrapped must be greater than 0']),
));

test('With name, default', catchAll(
    fn() => v::named(v::each(v::named(v::intType(), 'Wrapped')), 'Wrapper')->assert(['a', 'b', 'c']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapped must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each item in Wrapped must be valid
          - `.0` must be an integer
          - `.1` must be an integer
          - `.2` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each item in Wrapped must be valid',
            0 => '`.0` must be an integer',
            1 => '`.1` must be an integer',
            2 => '`.2` must be an integer',
        ]),
));

test('With name, inverted', catchAll(
    fn() => v::named(v::not(v::named(v::each(v::named(v::intType(), 'Wrapped')), 'Wrapper')), 'Not')->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapped must not be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each item in Wrapped must be invalid
          - `.0` must not be an integer
          - `.1` must not be an integer
          - `.2` must not be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each item in Wrapped must be invalid',
            0 => '`.0` must not be an integer',
            1 => '`.1` must not be an integer',
            2 => '`.2` must not be an integer',
        ]),
));

test('With wrapper name, default', catchAll(
    fn() => v::named(v::each(v::intType()), 'Wrapper')->assert(['a', 'b', 'c']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.0` (<- Wrapper) must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each item in Wrapper must be valid
          - `.0` must be an integer
          - `.1` must be an integer
          - `.2` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each item in Wrapper must be valid',
            0 => '`.0` must be an integer',
            1 => '`.1` must be an integer',
            2 => '`.2` must be an integer',
        ]),
));

test('With wrapper name, inverted', catchAll(
    fn() => v::named(v::not(v::named(v::each(v::intType()), 'Wrapper')), 'Not')->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.0` (<- Wrapper) must not be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each item in Wrapper must be invalid
          - `.0` must not be an integer
          - `.1` must not be an integer
          - `.2` must not be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each item in Wrapper must be invalid',
            0 => '`.0` must not be an integer',
            1 => '`.1` must not be an integer',
            2 => '`.2` must not be an integer',
        ]),
));

test('With Not name, inverted', catchAll(
    fn() => v::named(v::not(v::each(v::intType())), 'Not')->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.0` (<- Not) must not be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each item in Not must be invalid
          - `.0` must not be an integer
          - `.1` must not be an integer
          - `.2` must not be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each item in Not must be invalid',
            0 => '`.0` must not be an integer',
            1 => '`.1` must not be an integer',
            2 => '`.2` must not be an integer',
        ]),
));

test('With template, non-iterable', catchAll(
    fn() => v::each(v::intType())->setTemplate('You should have passed an iterable')->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('You should have passed an iterable')
        ->and($fullMessage)->toBe('- You should have passed an iterable')
        ->and($messages)->toBe(['each' => 'You should have passed an iterable']),
));

test('With template, empty', catchAll(
    fn() => v::each(v::intType())->setTemplate('You should have passed an non-empty')
        ->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('You should have passed an non-empty')
        ->and($fullMessage)->toBe('- You should have passed an non-empty')
        ->and($messages)->toBe(['each' => 'You should have passed an non-empty']),
));

test('With template, default', catchAll(
    fn() => v::each(v::intType())
        ->setTemplate('All items should have been integers')
        ->assert(['a', 'b', 'c']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('All items should have been integers')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - All items should have been integers
              - `.0` must be an integer
              - `.1` must be an integer
              - `.2` must be an integer
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'All items should have been integers',
            0 => '`.0` must be an integer',
            1 => '`.1` must be an integer',
            2 => '`.2` must be an integer',
        ]),
));

test('with template, inverted', catchAll(
    fn() => v::not(v::each(v::intType()))
        ->setTemplate('All items should not have been integers')
        ->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('All items should not have been integers')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - All items should not have been integers
              - `.0` must not be an integer
              - `.1` must not be an integer
              - `.2` must not be an integer
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'All items should not have been integers',
            0 => '`.0` must not be an integer',
            1 => '`.1` must not be an integer',
            2 => '`.2` must not be an integer',
        ]),
));

test('With array template, default', catchAll(
    fn() => v::each(v::intType())
        ->setTemplates([
            '__root__' => 'Here a sequence of items that did not pass the validation',
            0 => 'First item should have been an integer',
            1 => 'Second item should have been an integer',
            2 => 'Third item should have been an integer',
        ])
        ->assert(['a', 'b', 'c']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('First item should have been an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Here a sequence of items that did not pass the validation
          - First item should have been an integer
          - Second item should have been an integer
          - Third item should have been an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Here a sequence of items that did not pass the validation',
            0 => 'First item should have been an integer',
            1 => 'Second item should have been an integer',
            2 => 'Third item should have been an integer',
        ]),
));

test('With array template and name, default', catchAll(
    fn() => v::named(v::each(v::named(v::intType(), 'Wrapped')), 'Wrapper')
        ->setTemplates([
            '__root__' => 'Here a sequence of items that did not pass the validation',
            0 => 'First item should have been an integer',
            1 => 'Second item should have been an integer',
            2 => 'Third item should have been an integer',
        ])
        ->assert(['a', 'b', 'c']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('First item should have been an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Here a sequence of items that did not pass the validation
          - First item should have been an integer
          - Second item should have been an integer
          - Third item should have been an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Here a sequence of items that did not pass the validation',
            0 => 'First item should have been an integer',
            1 => 'Second item should have been an integer',
            2 => 'Third item should have been an integer',
        ]),
));

test('Chained wrapped rule', catchAll(
    fn() => v::each(v::between(5, 7)->odd())->assert([2, 4]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.0` must be between 5 and 7')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each item in `[2, 4]` must be valid
          - `.0` must pass all the rules
            - `.0` must be between 5 and 7
            - `.0` must be an odd number
          - `.1` must pass all the rules
            - `.1` must be between 5 and 7
            - `.1` must be an odd number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each item in `[2, 4]` must be valid',
            0 => '`.0` must be an odd number',
            1 => '`.1` must be an odd number',
        ]),
));

test('Multiple nested rules', catchAll(
    fn() => v::each(v::arrayType()->key('my_int', v::intType()->odd()))->assert([['not_int' => 'wrong'], ['my_int' => 2], 'not an array']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.0.my_int` must be present')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each item in `[["not_int": "wrong"], ["my_int": 2], "not an array"]` must be valid
          - `.0` must pass the rules
            - `.0.my_int` must be present
          - `.1` must pass the rules
            - `.1.my_int` must be an odd number
          - `.2` must pass all the rules
            - `.2` must be an array
            - `.2.my_int` must be present
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each item in `[["not_int": "wrong"], ["my_int": 2], "not an array"]` must be valid',
            0 => '`.0.my_int` must be present',
            1 => '`.1.my_int` must be an odd number',
            2 => [
                '__root__' => '`.2` must pass all the rules',
                2 => '`.2` must be an array',
                'my_int' => '`.2.my_int` must be present',
            ],
        ]),
));
