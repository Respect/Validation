<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::boolVal()->assert('ok'),
    fn(string $message) => expect($message)->toBe('"ok" must be a boolean value'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::boolVal())->assert('yes'),
    fn(string $message) => expect($message)->toBe('"yes" must not be a boolean value'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::boolVal()->assert('yep'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "yep" must be a boolean value'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::boolVal())->assert('on'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "on" must not be a boolean value'),
));
