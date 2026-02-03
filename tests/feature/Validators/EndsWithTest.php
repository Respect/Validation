<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

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
