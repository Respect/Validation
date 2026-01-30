<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::dynamic(fn() => v::intType())->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`true` must be an integer')
        ->and($fullMessage)->toBe('- `true` must be an integer')
        ->and($messages)->toBe(['intType' => '`true` must be an integer']),
));

test('Inverted', catchAll(
    fn() => v::not(v::dynamic(fn() => v::intType()))->assert(2),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('2 must not be an integer')
        ->and($fullMessage)->toBe('- 2 must not be an integer')
        ->and($messages)->toBe(['notIntType' => '2 must not be an integer']),
));

test('With created name, default', catchAll(
    fn() => v::named('Wrapper', v::dynamic(fn() => v::named('Created', v::intType())))->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Created must be an integer')
        ->and($fullMessage)->toBe('- Created must be an integer')
        ->and($messages)->toBe(['intType' => 'Created must be an integer']),
));

test('With wrapper name, default', catchAll(
    fn() => v::named('Wrapper', v::dynamic(fn() => v::intType()))->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapper must be an integer')
        ->and($fullMessage)->toBe('- Wrapper must be an integer')
        ->and($messages)->toBe(['intType' => 'Wrapper must be an integer']),
));

test('With created name, inverted', catchAll(
    fn() => v::named('Not', v::not(v::named('Wrapped', v::dynamic(fn() => v::named('Created', v::intType())))))->assert(2),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Created must not be an integer')
        ->and($fullMessage)->toBe('- Created must not be an integer')
        ->and($messages)->toBe(['notIntType' => 'Created must not be an integer']),
));

test('With wrapper name, inverted', catchAll(
    fn() => v::named('Not', v::not(v::named('Wrapped', v::dynamic(fn() => v::intType()))))->assert(2),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapped must not be an integer')
        ->and($fullMessage)->toBe('- Wrapped must not be an integer')
        ->and($messages)->toBe(['notIntType' => 'Wrapped must not be an integer']),
));

test('With not name, inverted', catchAll(
    fn() => v::named('Not', v::not(v::dynamic(fn() => v::intType())))->assert(2),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Not must not be an integer')
        ->and($fullMessage)->toBe('- Not must not be an integer')
        ->and($messages)->toBe(['notIntType' => 'Not must not be an integer']),
));

test('With template, default', catchAll(
    fn() => v::dynamic(fn() => v::intType())->assert(true, 'Dynamic lizards lounging like lords in the local lagoon'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Dynamic lizards lounging like lords in the local lagoon')
        ->and($fullMessage)->toBe('- Dynamic lizards lounging like lords in the local lagoon')
        ->and($messages)->toBe(['intType' => 'Dynamic lizards lounging like lords in the local lagoon']),
));
