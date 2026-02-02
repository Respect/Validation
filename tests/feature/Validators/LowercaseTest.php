<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::lowercase()->assert('UPPERCASE'),
    fn(string $message) => expect($message)->toBe('"UPPERCASE" must consist only of lowercase letters'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::lowercase())->assert('lowercase'),
    fn(string $message) => expect($message)->toBe('"lowercase" must not consist only of lowercase letters'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::lowercase()->assert('UPPERCASE'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "UPPERCASE" must consist only of lowercase letters'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::lowercase())->assert('lowercase'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "lowercase" must not consist only of lowercase letters'),
));
