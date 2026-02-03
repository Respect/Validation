<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::negative()->assert(16),
    fn(string $message) => expect($message)->toBe('16 must be a negative number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::negative())->assert(-10),
    fn(string $message) => expect($message)->toBe('-10 must not be a negative number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::negative()->assert('a'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "a" must be a negative number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::negative())->assert('-144'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "-144" must not be a negative number'),
));
