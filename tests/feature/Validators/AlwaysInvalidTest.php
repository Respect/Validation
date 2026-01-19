<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::alwaysInvalid()->assert('whatever'),
    fn(string $message) => expect($message)->toBe('"whatever" must be valid'),
));

test('Scenario #2', catchFullMessage(
    fn() => v::alwaysInvalid()->assert(''),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "" must be valid'),
));
