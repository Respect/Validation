<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::lazy(
        fn() => v::intType(),
    )->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`true` must be an integer')
        ->and($fullMessage)->toBe('- `true` must be an integer')
        ->and($messages)->toBe(['intType' => '`true` must be an integer']),
));

test('Inverted', catchAll(
    fn() => v::not(v::lazy(
        fn() => v::intType(),
    ))->assert(2),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('2 must not be an integer')
        ->and($fullMessage)->toBe('- 2 must not be an integer')
        ->and($messages)->toBe(['notIntType' => '2 must not be an integer']),
));

test('With created name, default', catchAll(
    fn() => v::named(v::lazy(
        fn() => v::named(v::intType(), 'Created'),
    ), 'Wrapper')->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Created must be an integer')
        ->and($fullMessage)->toBe('- Created must be an integer')
        ->and($messages)->toBe(['intType' => 'Created must be an integer']),
));

test('With wrapper name, default', catchAll(
    fn() => v::named(v::lazy(
        fn() => v::intType(),
    ), 'Wrapper')->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapper must be an integer')
        ->and($fullMessage)->toBe('- Wrapper must be an integer')
        ->and($messages)->toBe(['intType' => 'Wrapper must be an integer']),
));

test('With created name, inverted', catchAll(
    fn() => v::named(v::not(v::named(v::lazy(
        fn() => v::named(v::intType(), 'Created'),
    ), 'Wrapped')), 'Not')->assert(2),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Created must not be an integer')
        ->and($fullMessage)->toBe('- Created must not be an integer')
        ->and($messages)->toBe(['notIntType' => 'Created must not be an integer']),
));

test('With wrapper name, inverted', catchAll(
    fn() => v::named(v::not(v::named(v::lazy(
        fn() => v::intType(),
    ), 'Wrapped')), 'Not')->assert(2),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapped must not be an integer')
        ->and($fullMessage)->toBe('- Wrapped must not be an integer')
        ->and($messages)->toBe(['notIntType' => 'Wrapped must not be an integer']),
));

test('With not name, inverted', catchAll(
    fn() => v::named(v::not(v::lazy(
        fn() => v::intType(),
    )), 'Not')->assert(2),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Not must not be an integer')
        ->and($fullMessage)->toBe('- Not must not be an integer')
        ->and($messages)->toBe(['notIntType' => 'Not must not be an integer']),
));

test('With template, default', catchAll(
    fn() => v::lazy(
        fn() => v::intType(),
    )->assert(true, 'Lazy lizards lounging like lords in the local lagoon'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Lazy lizards lounging like lords in the local lagoon')
        ->and($fullMessage)->toBe('- Lazy lizards lounging like lords in the local lagoon')
        ->and($messages)->toBe(['intType' => 'Lazy lizards lounging like lords in the local lagoon']),
));
