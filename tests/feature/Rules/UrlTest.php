<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::url()->assert('example.com'),
    fn(string $message) => expect($message)->toBe('"example.com" must be a URL')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::url())->assert('http://example.com'),
    fn(string $message) => expect($message)->toBe('"http://example.com" must not be a URL')
));

test('Scenario #3', catchFullMessage(
    fn() => v::url()->assert('example.com'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "example.com" must be a URL')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::url())->assert('http://example.com'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "http://example.com" must not be a URL')
));
