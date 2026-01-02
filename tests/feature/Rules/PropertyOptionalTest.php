<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::propertyOptional('foo', v::intType())->assert((object) ['foo' => 'string']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must be an integer')
        ->and($fullMessage)->toBe('- `.foo` must be an integer')
        ->and($messages)->toBe(['foo' => '`.foo` must be an integer']),
));

test('Inverted', catchAll(
    fn() => v::not(v::propertyOptional('foo', v::intType()))->assert((object) ['foo' => 12]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must not be an integer')
        ->and($fullMessage)->toBe('- `.foo` must not be an integer')
        ->and($messages)->toBe(['foo' => '`.foo` must not be an integer']),
));

test('Inverted with missing property', catchAll(
    fn() => v::not(v::propertyOptional('foo', v::intType()))->assert(new stdClass()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must be present')
        ->and($fullMessage)->toBe('- `.foo` must be present')
        ->and($messages)->toBe(['foo' => '`.foo` must be present']),
));

test('With wrapped name, default', catchAll(
    fn() => v::named(v::propertyOptional('foo', v::named(v::intType(), 'Wrapped')), 'Wrapper')->assert((object) ['foo' => 'string']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapped must be an integer')
        ->and($fullMessage)->toBe('- Wrapped must be an integer')
        ->and($messages)->toBe(['foo' => 'Wrapped must be an integer']),
));

test('With wrapped name, inverted', catchAll(
    fn() => v::named(v::not(v::named(v::propertyOptional('foo', v::named(v::intType(), 'Wrapped')), 'Wrapper')), 'Not')->assert((object) ['foo' => 12]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapped must not be an integer')
        ->and($fullMessage)->toBe('- Wrapped must not be an integer')
        ->and($messages)->toBe(['foo' => 'Wrapped must not be an integer']),
));

test('With wrapper name, default', catchAll(
    fn() => v::named(v::propertyOptional('foo', v::intType()), 'Wrapper')->assert((object) ['foo' => 'string']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` (<- Wrapper) must be an integer')
        ->and($fullMessage)->toBe('- `.foo` (<- Wrapper) must be an integer')
        ->and($messages)->toBe(['foo' => '`.foo` (<- Wrapper) must be an integer']),
));

test('With wrapper name, inverted', catchAll(
    fn() => v::named(v::not(v::named(v::propertyOptional('foo', v::intType()), 'Wrapper')), 'Not')->assert((object) ['foo' => 12]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` (<- Wrapper) must not be an integer')
        ->and($fullMessage)->toBe('- `.foo` (<- Wrapper) must not be an integer')
        ->and($messages)->toBe(['foo' => '`.foo` (<- Wrapper) must not be an integer']),
));

test('With "Not" name, inverted', catchAll(
    fn() => v::named(v::not(v::propertyOptional('foo', v::intType())), 'Not')->assert((object) ['foo' => 12]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` (<- Not) must not be an integer')
        ->and($fullMessage)->toBe('- `.foo` (<- Not) must not be an integer')
        ->and($messages)->toBe(['foo' => '`.foo` (<- Not) must not be an integer']),
));

test('With template, default', catchAll(
    fn() => v::propertyOptional('foo', v::intType())
            ->assert((object) ['foo' => 'string'], 'Proper property planners plan precise property plots'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Proper property planners plan precise property plots')
        ->and($fullMessage)->toBe('- Proper property planners plan precise property plots')
        ->and($messages)->toBe(['foo' => 'Proper property planners plan precise property plots']),
));

test('With template, inverted', catchAll(
    fn() => v::not(v::propertyOptional('foo', v::intType()))
            ->assert((object) ['foo' => 12], 'Not proving prudent property planning promotes prosperity'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Not proving prudent property planning promotes prosperity')
        ->and($fullMessage)->toBe('- Not proving prudent property planning promotes prosperity')
        ->and($messages)->toBe(['foo' => 'Not proving prudent property planning promotes prosperity']),
));
