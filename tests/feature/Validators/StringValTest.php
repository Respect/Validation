<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::stringVal()->assert([]),
    fn(string $message) => expect($message)->toBe('`[]` must be a string'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::stringVal())->assert(true),
    fn(string $message) => expect($message)->toBe('`true` must not be a string'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::stringVal()->assert(new stdClass()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `stdClass {}` must be a string'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::stringVal())->assert(42),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 42 must not be a string'),
));
