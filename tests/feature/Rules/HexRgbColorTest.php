<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::hexRgbColor()->assert('invalid'),
    fn(string $message) => expect($message)->toBe('"invalid" must be a hex RGB color')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::hexRgbColor())->assert('#808080'),
    fn(string $message) => expect($message)->toBe('"#808080" must not be a hex RGB color')
));

test('Scenario #3', catchFullMessage(
    fn() => v::hexRgbColor()->assert('invalid'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "invalid" must be a hex RGB color')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::hexRgbColor())->assert('#808080'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "#808080" must not be a hex RGB color')
));
