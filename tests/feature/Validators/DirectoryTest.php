<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::directory()->assert('batman'),
    fn(string $message) => expect($message)->toBe('"batman" must be a directory'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::directory())->assert(dirname('/etc/')),
    fn(string $message) => expect($message)->toBe('"/" must not be a directory'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::directory()->assert('ppz'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "ppz" must be a directory'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::directory())->assert(dirname('/etc/')),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "/" must not be a directory'),
));
