<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::leapYear()->assert('2009'),
    fn(string $message) => expect($message)->toBe('"2009" must be a valid leap year')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::leapYear())->assert('2008'),
    fn(string $message) => expect($message)->toBe('"2008" must not be a leap year')
));

test('Scenario #3', catchFullMessage(
    fn() => v::leapYear()->assert('2009-02-29'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "2009-02-29" must be a valid leap year')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::leapYear())->assert('2008'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "2008" must not be a leap year')
));
