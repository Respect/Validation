<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::tld()->assert('42'),
    fn(string $message) => expect($message)->toBe('"42" must be a valid top-level domain name'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::tld())->assert('com'),
    fn(string $message) => expect($message)->toBe('"com" must not be a valid top-level domain name'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::tld()->assert('1984'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1984" must be a valid top-level domain name'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::tld())->assert('com'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "com" must not be a valid top-level domain name'),
));
