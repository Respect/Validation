<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::multiple(3)->assert(22),
    fn(string $message) => expect($message)->toBe('22 must be a multiple of 3'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::multiple(3))->assert(9),
    fn(string $message) => expect($message)->toBe('9 must not be a multiple of 3'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::multiple(2)->assert(5),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 5 must be a multiple of 2'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::multiple(5))->assert(25),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 25 must not be a multiple of 5'),
));
