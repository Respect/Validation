<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::not(v::alwaysValid())->assert(true),
    fn(string $message) => expect($message)->toBe('`true` must be invalid'),
));

test('Scenario #2', catchFullMessage(
    fn() => v::not(v::alwaysValid())->assert(true),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `true` must be invalid'),
));
