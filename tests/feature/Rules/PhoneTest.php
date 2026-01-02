<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::phone()->assert('123'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"123" must be a valid telephone number')
        ->and($fullMessage)->toBe('- "123" must be a valid telephone number')
        ->and($messages)->toBe(['phone' => '"123" must be a valid telephone number']),
));

test('Country-specific', catchAll(
    fn() => v::phone('BR')->assert('+1 650 253 00 00'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"+1 650 253 00 00" must be a valid telephone number for country Brazil')
        ->and($fullMessage)->toBe('- "+1 650 253 00 00" must be a valid telephone number for country Brazil')
        ->and($messages)->toBe(['phone' => '"+1 650 253 00 00" must be a valid telephone number for country Brazil']),
));

test('Inverted', catchAll(
    fn() => v::not(v::phone())->assert('+55 11 91111 1111'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"+55 11 91111 1111" must not be a valid telephone number')
        ->and($fullMessage)->toBe('- "+55 11 91111 1111" must not be a valid telephone number')
        ->and($messages)->toBe(['notPhone' => '"+55 11 91111 1111" must not be a valid telephone number']),
));

test('Default with name', catchAll(
    fn() => v::named(v::phone(), 'Phone')->assert('123'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Phone must be a valid telephone number')
        ->and($fullMessage)->toBe('- Phone must be a valid telephone number')
        ->and($messages)->toBe(['phone' => 'Phone must be a valid telephone number']),
));

test('Country-specific with name', catchAll(
    fn() => v::named(v::phone('US'), 'Phone')->assert('123'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Phone must be a valid telephone number for country United States')
        ->and($fullMessage)->toBe('- Phone must be a valid telephone number for country United States')
        ->and($messages)->toBe(['phone' => 'Phone must be a valid telephone number for country United States']),
));
