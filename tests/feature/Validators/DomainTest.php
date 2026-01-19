<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::domain()->assert('batman'),
    fn(string $message) => expect($message)->toBe('"batman" must be a valid domain'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::domain())->assert('r--w.com'),
    fn(string $message) => expect($message)->toBe('"r--w.com" must not be a valid domain'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::domain()->assert('p-éz-.kk'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "p-éz-.kk" must be a valid domain'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::domain())->assert('github.com'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "github.com" must not be a valid domain'),
));
