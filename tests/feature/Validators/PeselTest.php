<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

test('Scenario #1', catchMessage(
    fn() => v::pesel()->assert('21120209251'),
    fn(string $message) => expect($message)->toBe('"21120209251" must be a valid PESEL'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::pesel())->assert('21120209256'),
    fn(string $message) => expect($message)->toBe('"21120209256" must not be a valid PESEL'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::pesel()->assert('21120209251'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "21120209251" must be a valid PESEL'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::pesel())->assert('21120209256'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "21120209256" must not be a valid PESEL'),
));
