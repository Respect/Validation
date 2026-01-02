<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::iterableType()->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`null` must be iterable')
        ->and($fullMessage)->toBe('- `null` must be iterable')
        ->and($messages)->toBe(['iterableType' => '`null` must be iterable']),
));

test('Inverted', catchAll(
    fn() => v::not(v::iterableType())->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[1, 2, 3]` must not iterable')
        ->and($fullMessage)->toBe('- `[1, 2, 3]` must not iterable')
        ->and($messages)->toBe(['notIterableType' => '`[1, 2, 3]` must not iterable']),
));

test('With template', catchAll(
    fn() => v::iterableType()->assert(null, 'Not an iterable at all'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Not an iterable at all')
        ->and($fullMessage)->toBe('- Not an iterable at all')
        ->and($messages)->toBe(['iterableType' => 'Not an iterable at all']),
));

test('With name', catchAll(
    fn() => v::named(v::iterableType(), 'Options')->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Options must be iterable')
        ->and($fullMessage)->toBe('- Options must be iterable')
        ->and($messages)->toBe(['iterableType' => 'Options must be iterable']),
));
