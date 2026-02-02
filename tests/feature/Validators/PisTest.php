<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::pis()->assert('this thing'),
    fn(string $message) => expect($message)->toBe('"this thing" must be a PIS number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::pis())->assert('120.6671.406-4'),
    fn(string $message) => expect($message)->toBe('"120.6671.406-4" must not be a PIS number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::pis()->assert('your mother'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "your mother" must be a PIS number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::pis())->assert('120.9378.174-5'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "120.9378.174-5" must not be a PIS number'),
));
