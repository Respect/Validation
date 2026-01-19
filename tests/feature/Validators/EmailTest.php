<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::email()->assert('batman'),
    fn(string $message) => expect($message)->toBe('"batman" must be a valid email address'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::email())->assert('bruce.wayne@gothancity.com'),
    fn(string $message) => expect($message)->toBe('"bruce.wayne@gothancity.com" must not be an email address'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::email()->assert('bruce wayne'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "bruce wayne" must be a valid email address'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::email())->assert('iambatman@gothancity.com'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "iambatman@gothancity.com" must not be an email address'),
));
