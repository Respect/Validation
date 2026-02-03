<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::numericVal()->assert('a'),
    fn(string $message) => expect($message)->toBe('"a" must be a numeric value'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::numericVal())->assert('1'),
    fn(string $message) => expect($message)->toBe('"1" must not be a numeric value'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::numericVal()->assert('a'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "a" must be a numeric value'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::numericVal())->assert('1'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1" must not be a numeric value'),
));
