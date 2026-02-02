<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Scenario #1', catchMessage(
    fn() => v::time()->assert('2018-01-30'),
    fn(string $message) => expect($message)->toBe('"2018-01-30" must be a time in the "23:59:59" format'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::time())->assert('09:25:46'),
    fn(string $message) => expect($message)->toBe('"09:25:46" must not be a time in the "23:59:59" format'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::time()->assert('2018-01-30'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "2018-01-30" must be a time in the "23:59:59" format'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::time('g:i A'))->assert('8:13 AM'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "8:13 AM" must not be a time in the "11:59 PM" format'),
));
