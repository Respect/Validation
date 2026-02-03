<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::bsn()->assert('acb'),
    fn(string $message) => expect($message)->toBe('"acb" must be a valid BSN'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::bsn())->assert('612890053'),
    fn(string $message) => expect($message)->toBe('"612890053" must not be a valid BSN'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::bsn()->assert('abc'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "abc" must be a valid BSN'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::bsn())->assert('612890053'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "612890053" must not be a valid BSN'),
));
