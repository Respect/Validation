<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
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
