<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::imei()->assert('490154203237512'),
    fn(string $message) => expect($message)->toBe('"490154203237512" must be a valid IMEI number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::imei())->assert('350077523237513'),
    fn(string $message) => expect($message)->toBe('"350077523237513" must not be a valid IMEI number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::imei()->assert(null),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `null` must be a valid IMEI number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::imei())->assert('356938035643809'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "356938035643809" must not be a valid IMEI number'),
));
