<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
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
    fn() => v::named('Options', v::iterableType())->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Options must be iterable')
        ->and($fullMessage)->toBe('- Options must be iterable')
        ->and($messages)->toBe(['iterableType' => 'Options must be iterable']),
));
