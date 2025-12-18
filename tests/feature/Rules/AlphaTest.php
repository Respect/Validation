<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::alpha()->assert('aaa%a'),
    fn(string $message) => expect($message)->toBe('"aaa%a" must contain only letters (a-z)')
));

test('Scenario #2', catchMessage(
    fn() => v::alpha(' ')->assert('bbb%b'),
    fn(string $message) => expect($message)->toBe('"bbb%b" must contain only letters (a-z) and " "')
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::alpha())->assert('ccccc'),
    fn(string $message) => expect($message)->toBe('"ccccc" must not contain letters (a-z)')
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::alpha('% '))->assert('ddd%d'),
    fn(string $message) => expect($message)->toBe('"ddd%d" must not contain letters (a-z) or "% "')
));

test('Scenario #5', catchFullMessage(
    fn() => v::alpha()->assert('eee^e'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "eee^e" must contain only letters (a-z)')
));

test('Scenario #6', catchFullMessage(
    fn() => v::not(v::alpha())->assert('fffff'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "fffff" must not contain letters (a-z)')
));

test('Scenario #7', catchFullMessage(
    fn() => v::alpha('* &%')->assert('ggg^g'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "ggg^g" must contain only letters (a-z) and "* &%"')
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::alpha('^'))->assert('hhh^h'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "hhh^h" must not contain letters (a-z) or "^"')
));
