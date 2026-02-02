<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::resourceType()->assert('test'),
    fn(string $message) => expect($message)->toBe('"test" must be an internal resource'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::resourceType())->assert(tmpfile()),
    fn(string $message) => expect($message)->toBe('`resource <stream>` must not be an internal resource'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::resourceType()->assert([]),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `[]` must be an internal resource'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::resourceType())->assert(tmpfile()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `resource <stream>` must not be an internal resource'),
));
