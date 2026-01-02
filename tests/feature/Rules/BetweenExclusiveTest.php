<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::betweenExclusive(1, 10)->assert(12),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('12 must be greater than 1 and less than 10')
        ->and($fullMessage)->toBe('- 12 must be greater than 1 and less than 10')
        ->and($messages)->toBe(['betweenExclusive' => '12 must be greater than 1 and less than 10']),
));

test('Inverted', catchAll(
    fn() => v::not(v::betweenExclusive(1, 10))->assert(5),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('5 must not be greater than 1 or less than 10')
        ->and($fullMessage)->toBe('- 5 must not be greater than 1 or less than 10')
        ->and($messages)->toBe(['notBetweenExclusive' => '5 must not be greater than 1 or less than 10']),
));

test('With template', catchAll(
    fn() => v::templated(v::betweenExclusive(1, 10), 'Bewildered bees buzzed between blooming begonias')->assert(12),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Bewildered bees buzzed between blooming begonias')
        ->and($fullMessage)->toBe('- Bewildered bees buzzed between blooming begonias')
        ->and($messages)->toBe(['betweenExclusive' => 'Bewildered bees buzzed between blooming begonias']),
));

test('With name', catchAll(
    fn() => v::named(v::betweenExclusive(1, 10), 'Range')->assert(10),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Range must be greater than 1 and less than 10')
        ->and($fullMessage)->toBe('- Range must be greater than 1 and less than 10')
        ->and($messages)->toBe(['betweenExclusive' => 'Range must be greater than 1 and less than 10']),
));
