<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::keyOptional('foo', v::intType())->assert(['foo' => 'string']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must be an integer')
        ->and($fullMessage)->toBe('- `.foo` must be an integer')
        ->and($messages)->toBe(['foo' => '`.foo` must be an integer']),
));

test('Inverted', catchAll(
    fn() => v::not(v::keyOptional('foo', v::intType()))->assert(['foo' => 12]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must not be an integer')
        ->and($fullMessage)->toBe('- `.foo` must not be an integer')
        ->and($messages)->toBe(['foo' => '`.foo` must not be an integer']),
));

test('Inverted with missing key', catchAll(
    fn() => v::not(v::keyOptional('foo', v::intType()))->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must be present')
        ->and($fullMessage)->toBe('- `.foo` must be present')
        ->and($messages)->toBe(['foo' => '`.foo` must be present']),
));

test('With wrapped name, default', catchAll(
    fn() => v::named(v::keyOptional('foo', v::named(v::intType(), 'Wrapped')), 'Wrapper')->assert(['foo' => 'string']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapped must be an integer')
        ->and($fullMessage)->toBe('- Wrapped must be an integer')
        ->and($messages)->toBe(['foo' => 'Wrapped must be an integer']),
));

test('With wrapped name, inverted', catchAll(
    fn() => v::named(v::not(v::named(v::keyOptional('foo', v::named(v::intType(), 'Wrapped')), 'Wrapper')), 'Not')->assert(['foo' => 12]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapped must not be an integer')
        ->and($fullMessage)->toBe('- Wrapped must not be an integer')
        ->and($messages)->toBe(['foo' => 'Wrapped must not be an integer']),
));

test('With wrapper name, default', catchAll(
    fn() => v::named(v::keyOptional('foo', v::intType()), 'Wrapper')->assert(['foo' => 'string']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` (<- Wrapper) must be an integer')
        ->and($fullMessage)->toBe('- `.foo` (<- Wrapper) must be an integer')
        ->and($messages)->toBe(['foo' => '`.foo` (<- Wrapper) must be an integer']),
));

test('With wrapper name, inverted', catchAll(
    fn() => v::named(v::not(v::named(v::keyOptional('foo', v::intType()), 'Wrapper')), 'Not')->assert(['foo' => 12]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` (<- Wrapper) must not be an integer')
        ->and($fullMessage)->toBe('- `.foo` (<- Wrapper) must not be an integer')
        ->and($messages)->toBe(['foo' => '`.foo` (<- Wrapper) must not be an integer']),
));

test('With "Not" name, inverted', catchAll(
    fn() => v::named(v::not(v::keyOptional('foo', v::intType())), 'Not')->assert(['foo' => 12]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` (<- Not) must not be an integer')
        ->and($fullMessage)->toBe('- `.foo` (<- Not) must not be an integer')
        ->and($messages)->toBe(['foo' => '`.foo` (<- Not) must not be an integer']),
));

test('With template, default', catchAll(
    fn() => v::keyOptional('foo', v::intType())->assert(['foo' => 'string'], 'That key is off-key'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('That key is off-key')
        ->and($fullMessage)->toBe('- That key is off-key')
        ->and($messages)->toBe(['foo' => 'That key is off-key']),
));

test('With template, inverted', catchAll(
    fn() => v::not(v::keyOptional('foo', v::intType()))->assert(['foo' => 12], 'No off-key key'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('No off-key key')
        ->and($fullMessage)->toBe('- No off-key key')
        ->and($messages)->toBe(['foo' => 'No off-key key']),
));
