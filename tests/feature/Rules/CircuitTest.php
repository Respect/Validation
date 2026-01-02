<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::circuit(v::alwaysValid(), v::trueVal())->assert(false),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`false` must evaluate to `true`')
        ->and($fullMessage)->toBe('- `false` must evaluate to `true`')
        ->and($messages)->toBe(['trueVal' => '`false` must evaluate to `true`']),
));

test('Inverted', catchAll(
    fn() => v::not(v::circuit(v::alwaysValid(), v::trueVal()))->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`true` must not evaluate to `true`')
        ->and($fullMessage)->toBe('- `true` must not evaluate to `true`')
        ->and($messages)->toBe(['notTrueVal' => '`true` must not evaluate to `true`']),
));

test('Default with inverted failing rule', catchAll(
    fn() => v::circuit(v::alwaysValid(), v::not(v::trueVal()))->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`true` must not evaluate to `true`')
        ->and($fullMessage)->toBe('- `true` must not evaluate to `true`')
        ->and($messages)->toBe(['notTrueVal' => '`true` must not evaluate to `true`']),
));

test('With wrapped name, default', catchAll(
    fn() => v::named(v::circuit(v::alwaysValid(), v::named(v::trueVal(), 'Wrapped')), 'Wrapper')->assert(false),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapped must evaluate to `true`')
        ->and($fullMessage)->toBe('- Wrapped must evaluate to `true`')
        ->and($messages)->toBe(['trueVal' => 'Wrapped must evaluate to `true`']),
));

test('With wrapper name, default', catchAll(
    fn() => v::named(v::circuit(v::alwaysValid(), v::trueVal()), 'Wrapper')->assert(false),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapper must evaluate to `true`')
        ->and($fullMessage)->toBe('- Wrapper must evaluate to `true`')
        ->and($messages)->toBe(['trueVal' => 'Wrapper must evaluate to `true`']),
));

test('With the name set in the wrapped rule of an inverted failing rule', catchAll(
    fn() => v::named(v::circuit(v::alwaysValid(), v::named(v::not(v::named(v::trueVal(), 'Wrapped')), 'Not')), 'Wrapper')->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapped must not evaluate to `true`')
        ->and($fullMessage)->toBe('- Wrapped must not evaluate to `true`')
        ->and($messages)->toBe(['notTrueVal' => 'Wrapped must not evaluate to `true`']),
));

test('With the name set in an inverted failing rule', catchAll(
    fn() => v::named(v::circuit(v::alwaysValid(), v::named(v::not(v::trueVal()), 'Not')), 'Wrapper')->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Not must not evaluate to `true`')
        ->and($fullMessage)->toBe('- Not must not evaluate to `true`')
        ->and($messages)->toBe(['notTrueVal' => 'Not must not evaluate to `true`']),
));

test('With the name set in the "circuit" that has an inverted failing rule', catchAll(
    fn() => v::named(v::circuit(v::alwaysValid(), v::not(v::trueVal())), 'Wrapper')->assert(true),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapper must not evaluate to `true`')
        ->and($fullMessage)->toBe('- Wrapper must not evaluate to `true`')
        ->and($messages)->toBe(['notTrueVal' => 'Wrapper must not evaluate to `true`']),
));

test('With template', catchAll(
    fn() => v::circuit(v::alwaysValid(), v::trueVal())
        ->setTemplate('Circuit cool cats cunningly continuous cookies')
        ->assert(false),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Circuit cool cats cunningly continuous cookies')
        ->and($fullMessage)->toBe('- Circuit cool cats cunningly continuous cookies')
        ->and($messages)->toBe(['trueVal' => 'Circuit cool cats cunningly continuous cookies']),
));

test('With multiple templates', catchAll(
    fn() => v::circuit(v::alwaysValid(), v::trueVal())
        ->setTemplates(['trueVal' => 'Clever clowns craft circuit clever clocks'])
        ->assert(false),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Clever clowns craft circuit clever clocks')
        ->and($fullMessage)->toBe('- Clever clowns craft circuit clever clocks')
        ->and($messages)->toBe(['trueVal' => 'Clever clowns craft circuit clever clocks']),
));

test('Real example', catchAll(
    fn() => v::circuit(
        v::key('countyCode', v::countryCode()),
        v::lazy(
            fn($input) => v::key('subdivisionCode', v::subdivisionCode($input['countyCode'])),
        ),
    )->assert(['countyCode' => 'BR', 'subdivisionCode' => 'CA']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.subdivisionCode` must be a subdivision code of Brazil')
        ->and($fullMessage)->toBe('- `.subdivisionCode` must be a subdivision code of Brazil')
        ->and($messages)->toBe(['subdivisionCode' => '`.subdivisionCode` must be a subdivision code of Brazil']),
));
