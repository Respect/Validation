<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::floatVal()->assert('a'),
    fn(string $message) => expect($message)->toBe('"a" must be a floating-point number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::floatVal())->assert(165.0),
    fn(string $message) => expect($message)->toBe('165.0 must not be a floating-point number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::floatVal()->assert('a'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "a" must be a floating-point number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::floatVal())->assert('165.7'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "165.7" must not be a floating-point number'),
));
