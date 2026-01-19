<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::cnh()->assert('batman'),
    fn(string $message) => expect($message)->toBe('"batman" must be a valid CNH number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::cnh())->assert('02650306461'),
    fn(string $message) => expect($message)->toBe('"02650306461" must not be a valid CNH number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::cnh()->assert('bruce wayne'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "bruce wayne" must be a valid CNH number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::cnh())->assert('02650306461'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "02650306461" must not be a valid CNH number'),
));
