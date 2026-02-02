<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::satisfies('is_string')->assert([]),
    fn(string $message) => expect($message)->toBe('`[]` must be valid'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::satisfies('is_string'))->assert('foo'),
    fn(string $message) => expect($message)->toBe('"foo" must not be valid'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::satisfies('is_string')->assert(true),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `true` must be valid'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::satisfies('is_string'))->assert('foo'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "foo" must not be valid'),
));
