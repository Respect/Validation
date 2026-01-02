<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::length(v::equals(3))->assert('tulip'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The length of "tulip" must be equal to 3')
        ->and($fullMessage)->toBe('- The length of "tulip" must be equal to 3')
        ->and($messages)->toBe(['lengthEquals' => 'The length of "tulip" must be equal to 3']),
));

test('Inverted wrapped', catchAll(
    fn() => v::length(v::not(v::equals(4)))->assert('rose'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The length of "rose" must not be equal to 4')
        ->and($fullMessage)->toBe('- The length of "rose" must not be equal to 4')
        ->and($messages)->toBe(['lengthNotEquals' => 'The length of "rose" must not be equal to 4']),
));

test('Inverted wrapper', catchAll(
    fn() => v::not(v::length(v::equals(4)))->assert('fern'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The length of "fern" must not be equal to 4')
        ->and($fullMessage)->toBe('- The length of "fern" must not be equal to 4')
        ->and($messages)->toBe(['notLengthEquals' => 'The length of "fern" must not be equal to 4']),
));

test('With template', catchAll(
    fn() => v::length(v::equals(3))->assert('azalea', 'This is a template'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('This is a template')
        ->and($fullMessage)->toBe('- This is a template')
        ->and($messages)->toBe(['lengthEquals' => 'This is a template']),
));

test('With wrapper name', catchAll(
    fn() => v::named(v::length(v::equals(3)), 'Cactus')->assert('peyote'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The length of Cactus must be equal to 3')
        ->and($fullMessage)->toBe('- The length of Cactus must be equal to 3')
        ->and($messages)->toBe(['lengthEquals' => 'The length of Cactus must be equal to 3']),
));

test('Chained wrapped rule', catchAll(
    fn() => v::length(v::between(5, 7)->odd())->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The length of `[]` must be between 5 and 7')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `[]` must pass all the rules
          - The length of `[]` must be between 5 and 7
          - The length of `[]` must be an odd number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`[]` must pass all the rules',
            'lengthBetween' => 'The length of `[]` must be between 5 and 7',
            'lengthOdd' => 'The length of `[]` must be an odd number',
        ]),
));
