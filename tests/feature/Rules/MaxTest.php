<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Non-iterable', catchAll(
    fn() => v::max(v::negative())->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`null` must be iterable')
        ->and($fullMessage)->toBe('- `null` must be iterable')
        ->and($messages)->toBe(['max' => '`null` must be iterable']),
));

test('Empty', catchAll(
    fn() => v::max(v::negative())->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The length of `[]` must be greater than 0')
        ->and($fullMessage)->toBe('- The length of `[]` must be greater than 0')
        ->and($messages)->toBe(['max' => 'The length of `[]` must be greater than 0']),
));

test('Default', catchAll(
    fn() => v::max(v::negative())->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The maximum of `[1, 2, 3]` must be a negative number')
        ->and($fullMessage)->toBe('- The maximum of `[1, 2, 3]` must be a negative number')
        ->and($messages)->toBe(['maxNegative' => 'The maximum of `[1, 2, 3]` must be a negative number']),
));

test('Inverted', catchAll(
    fn() => v::not(v::max(v::negative()))->assert([-3, -2, -1]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The maximum of `[-3, -2, -1]` must not be a negative number')
        ->and($fullMessage)->toBe('- The maximum of `[-3, -2, -1]` must not be a negative number')
        ->and($messages)->toBe(['notMaxNegative' => 'The maximum of `[-3, -2, -1]` must not be a negative number']),
));

test('With wrapped name, default', catchAll(
    fn() => v::named(v::max(v::named(v::negative(), 'Wrapped')), 'Wrapper')->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The maximum of Wrapped must be a negative number')
        ->and($fullMessage)->toBe('- The maximum of Wrapped must be a negative number')
        ->and($messages)->toBe(['maxNegative' => 'The maximum of Wrapped must be a negative number']),
));

test('With wrapper name, default', catchAll(
    fn() => v::named(v::max(v::negative()), 'Wrapper')->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The maximum of Wrapper must be a negative number')
        ->and($fullMessage)->toBe('- The maximum of Wrapper must be a negative number')
        ->and($messages)->toBe(['maxNegative' => 'The maximum of Wrapper must be a negative number']),
));

test('With wrapped name, inverted', catchAll(
    fn() => v::named(v::not(v::max(v::named(v::negative(), 'Wrapped'))), 'Wrapper')->assert([-3, -2, -1]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The maximum of Wrapped must not be a negative number')
        ->and($fullMessage)->toBe('- The maximum of Wrapped must not be a negative number')
        ->and($messages)->toBe(['notMaxNegative' => 'The maximum of Wrapped must not be a negative number']),
));

test('With wrapper name, inverted', catchAll(
    fn() => v::named(v::not(v::max(v::negative())), 'Wrapper')->assert([-3, -2, -1]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The maximum of Wrapper must not be a negative number')
        ->and($fullMessage)->toBe('- The maximum of Wrapper must not be a negative number')
        ->and($messages)->toBe(['notMaxNegative' => 'The maximum of Wrapper must not be a negative number']),
));

test('With template, default', catchAll(
    fn() => v::max(v::negative())->assert([1, 2, 3], 'The maximum of the value is not what we expect'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The maximum of the value is not what we expect')
        ->and($fullMessage)->toBe('- The maximum of the value is not what we expect')
        ->and($messages)->toBe(['maxNegative' => 'The maximum of the value is not what we expect']),
));

test('Chained wrapped rule', catchAll(
    fn() => v::max(v::between(5, 7)->odd())->assert([1, 2, 3, 4]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The maximum of `[1, 2, 3, 4]` must be between 5 and 7')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `[1, 2, 3, 4]` must pass all the rules
          - The maximum of `[1, 2, 3, 4]` must be between 5 and 7
          - The maximum of `[1, 2, 3, 4]` must be an odd number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`[1, 2, 3, 4]` must pass all the rules',
            'maxBetween' => 'The maximum of `[1, 2, 3, 4]` must be between 5 and 7',
            'maxOdd' => 'The maximum of `[1, 2, 3, 4]` must be an odd number',
        ]),
));
