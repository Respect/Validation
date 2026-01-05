<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::ip()->assert('257.0.0.1'),
    fn(string $message) => expect($message)->toBe('"257.0.0.1" must be an IP address'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::ip())->assert('127.0.0.1'),
    fn(string $message) => expect($message)->toBe('"127.0.0.1" must not be an IP address'),
));

test('Scenario #3', catchMessage(
    fn() => v::ip('127.0.1.*')->assert('127.0.0.1'),
    fn(string $message) => expect($message)->toBe('"127.0.0.1" must be an IP address in the 127.0.1.0-127.0.1.255 range'),
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::ip('127.0.1.*'))->assert('127.0.1.1'),
    fn(string $message) => expect($message)->toBe('"127.0.1.1" must not be an IP address in the 127.0.1.0-127.0.1.255 range'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::ip()->assert('257.0.0.1'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "257.0.0.1" must be an IP address'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::not(v::ip())->assert('127.0.0.1'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "127.0.0.1" must not be an IP address'),
));

test('Scenario #7', catchFullMessage(
    fn() => v::ip('127.0.1.*')->assert('127.0.0.1'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "127.0.0.1" must be an IP address in the 127.0.1.0-127.0.1.255 range'),
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::ip('127.0.1.*'))->assert('127.0.1.1'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "127.0.1.1" must not be an IP address in the 127.0.1.0-127.0.1.255 range'),
));
