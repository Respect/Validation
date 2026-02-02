<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::macAddress()->assert('00-11222:33:44:55'),
    fn(string $message) => expect($message)->toBe('"00-11222:33:44:55" must be a MAC address'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::macAddress())->assert('00:11:22:33:44:55'),
    fn(string $message) => expect($message)->toBe('"00:11:22:33:44:55" must not be a MAC address'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::macAddress()->assert('90-bc-nk:1a-dd-cc'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "90-bc-nk:1a-dd-cc" must be a MAC address'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::macAddress())->assert('AF:0F:bd:12:44:ba'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "AF:0F:bd:12:44:ba" must not be a MAC address'),
));
