<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::base64()->assert('=c3VyZS4'),
    fn(string $message) => expect($message)->toBe('"=c3VyZS4" must be a base64 encoded string'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::base64())->assert('c3VyZS4='),
    fn(string $message) => expect($message)->toBe('"c3VyZS4=" must not be a base64 encoded string'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::base64()->assert('=c3VyZS4'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "=c3VyZS4" must be a base64 encoded string'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::base64())->assert('c3VyZS4='),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "c3VyZS4=" must not be a base64 encoded string'),
));
