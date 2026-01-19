<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::xdigit()->assert('aaa%a'),
    fn(string $message) => expect($message)->toBe('"aaa%a" must only contain hexadecimal digits'),
));

test('Scenario #2', catchMessage(
    fn() => v::xdigit(' ')->assert('bbb%b'),
    fn(string $message) => expect($message)->toBe('"bbb%b" must contain hexadecimal digits and " "'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::xdigit())->assert('ccccc'),
    fn(string $message) => expect($message)->toBe('"ccccc" must not only contain hexadecimal digits'),
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::xdigit('% '))->assert('ddd%d'),
    fn(string $message) => expect($message)->toBe('"ddd%d" must not contain hexadecimal digits or "% "'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::xdigit()->assert('eee^e'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "eee^e" must only contain hexadecimal digits'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::not(v::xdigit())->assert('fffff'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "fffff" must not only contain hexadecimal digits'),
));

test('Scenario #7', catchFullMessage(
    fn() => v::xdigit('* &%')->assert('000^0'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "000^0" must contain hexadecimal digits and "* &%"'),
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::xdigit('^'))->assert('111^1'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "111^1" must not contain hexadecimal digits or "^"'),
));
