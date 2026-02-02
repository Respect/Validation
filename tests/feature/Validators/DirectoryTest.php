<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::directory()->assert('batman'),
    fn(string $message) => expect($message)->toBe('"batman" must be an accessible existing directory'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::directory())->assert(dirname('/etc/')),
    fn(string $message) => expect($message)->toBe('"/" must not be an accessible existing directory'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::directory()->assert('ppz'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "ppz" must be an accessible existing directory'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::directory())->assert(dirname('/etc/')),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "/" must not be an accessible existing directory'),
));
