<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::leapDate('Y-m-d')->assert('1989-02-29'),
    fn(string $message) => expect($message)->toBe('"1989-02-29" must be a valid leap date'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::leapDate('Y-m-d'))->assert('1988-02-29'),
    fn(string $message) => expect($message)->toBe('"1988-02-29" must not be a leap date'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::leapDate('Y-m-d')->assert('1990-02-29'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1990-02-29" must be a valid leap date'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::leapDate('Y-m-d'))->assert('1992-02-29'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1992-02-29" must not be a leap date'),
));
