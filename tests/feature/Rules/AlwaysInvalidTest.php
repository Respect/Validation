<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
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
