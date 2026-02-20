<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

use Respect\Validation\Exceptions\ValidationException;

test('Scenario #1', catchMessage(
    fn() => v::endsWith('foo')->assert('bar'),
    fn(string $message) => expect($message)->toBe('"bar" must end with "foo"'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::endsWith('foo'))->assert(['bar', 'foo']),
    fn(string $message) => expect($message)->toBe('`["bar", "foo"]` must not end with "foo"'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::endsWith('foo')->assert(''),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "" must end with "foo"'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::endsWith('foo'))->assert(['bar', 'foo']),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `["bar", "foo"]` must not end with "foo"'),
));

test('Scenario #5', catchMessage(
    fn() => v::endsWith('Mr.', 'Dr.')->assert('John Doe'),
    fn(string $message) => expect($message)->toBe('"John Doe" must end with "Mr." or "Dr."'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::not(v::endsWith('divorced.', 'PhD.'))->assert('John Doe, PhD.'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "John Doe, PhD." must not end with "divorced." or "PhD."'),
));

// ensure non-string values do not throw errors and are considered invalid
test('non-string input or end value are invalid', function (): void {
    expect(fn() => v::endsWith('foo')->assert(123))
        ->toThrow(ValidationException::class);
    expect(fn() => v::endsWith(123)->assert('foo'))
        ->toThrow(ValidationException::class);
});
