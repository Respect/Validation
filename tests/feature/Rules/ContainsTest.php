<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::contains('foo')->assert('bar'),
    fn(string $message) => expect($message)->toBe('"bar" must contain "foo"'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::contains('foo'))->assert('fool'),
    fn(string $message) => expect($message)->toBe('"fool" must not contain "foo"'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::contains('foo')->assert(['bar']),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `["bar"]` must contain "foo"'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::contains('foo', true))->assert(['bar', 'foo']),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `["bar", "foo"]` must not contain "foo"'),
));
