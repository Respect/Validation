<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::callableType()->assert([]),
    fn(string $message) => expect($message)->toBe('`[]` must be a callable'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::callableType())->assert('trim'),
    fn(string $message) => expect($message)->toBe('"trim" must not be a callable'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::callableType()->assert(true),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `true` must be a callable'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::callableType())->assert(function (): void {
        // Do nothing
    }),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `Closure {}` must not be a callable'),
));
