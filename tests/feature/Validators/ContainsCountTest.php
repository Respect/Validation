<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::containsCount('foo', 2)->assert('bar'),
    fn(string $message) => expect($message)->toBe('"bar" must contain "foo" 2 time(s)'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::containsCount('foo', 2))->assert('foo bar foo'),
    fn(string $message) => expect($message)->toBe('"foo bar foo" must not contain "foo" 2 time(s)'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::containsCount('foo', 2)->assert(['foo']),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `["foo"]` must contain "foo" 2 time(s)'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::containsCount('foo', 1))->assert(['foo', 'bar']),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `["foo", "bar"]` must not contain "foo" only once'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::containsCount('foo', 1)->assert(['foo', 'foo']),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `["foo", "foo"]` must contain "foo" only once'),
));
