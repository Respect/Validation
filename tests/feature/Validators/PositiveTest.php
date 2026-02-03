<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::positive()->assert(-10),
    fn(string $message) => expect($message)->toBe('-10 must be a positive number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::positive())->assert(16),
    fn(string $message) => expect($message)->toBe('16 must not be a positive number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::positive()->assert('a'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "a" must be a positive number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::positive())->assert('165'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "165" must not be a positive number'),
));
