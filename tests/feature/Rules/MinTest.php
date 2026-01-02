<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::min(v::equals(1))->assert([2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The minimum of `[2, 3]` must be equal to 1')
        ->and($fullMessage)->toBe('- The minimum of `[2, 3]` must be equal to 1')
        ->and($messages)->toBe(['minEquals' => 'The minimum of `[2, 3]` must be equal to 1']),
));

test('Inverted', catchAll(
    fn() => v::not(v::min(v::equals(1)))->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The minimum of `[1, 2, 3]` must not be equal to 1')
        ->and($fullMessage)->toBe('- The minimum of `[1, 2, 3]` must not be equal to 1')
        ->and($messages)->toBe(['notMinEquals' => 'The minimum of `[1, 2, 3]` must not be equal to 1']),
));

test('With template', catchAll(
    fn() => v::min(v::equals(1))->assert([2, 3], 'That did not go as planned'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('That did not go as planned')
        ->and($fullMessage)->toBe('- That did not go as planned')
        ->and($messages)->toBe(['minEquals' => 'That did not go as planned']),
));

test('With name', catchAll(
    fn() => v::named(v::min(v::equals(1)), 'Options')->assert([2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The minimum of Options must be equal to 1')
        ->and($fullMessage)->toBe('- The minimum of Options must be equal to 1')
        ->and($messages)->toBe(['minEquals' => 'The minimum of Options must be equal to 1']),
));

test('Chained wrapped rule', catchAll(
    fn() => v::min(v::between(5, 7)->odd())->assert([2, 3, 4]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The minimum of `[2, 3, 4]` must be between 5 and 7')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `[2, 3, 4]` must pass all the rules
          - The minimum of `[2, 3, 4]` must be between 5 and 7
          - The minimum of `[2, 3, 4]` must be an odd number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`[2, 3, 4]` must pass all the rules',
            'minBetween' => 'The minimum of `[2, 3, 4]` must be between 5 and 7',
            'minOdd' => 'The minimum of `[2, 3, 4]` must be an odd number',
        ]),
));
