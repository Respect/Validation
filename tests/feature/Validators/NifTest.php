<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::nif()->assert('06357771Q'),
    fn(string $message) => expect($message)->toBe('"06357771Q" must be a NIF'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::nif())->assert('71110316C'),
    fn(string $message) => expect($message)->toBe('"71110316C" must not be a NIF'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::nif()->assert('06357771Q'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "06357771Q" must be a NIF'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::nif())->assert('R1332622H'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "R1332622H" must not be a NIF'),
));
