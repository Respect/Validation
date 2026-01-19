<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::falseVal()->assert(true),
    fn(string $message) => expect($message)->toBe('`true` must evaluate to `false`'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::falseVal())->assert('false'),
    fn(string $message) => expect($message)->toBe('"false" must not evaluate to `false`'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::falseVal()->assert(1),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 1 must evaluate to `false`'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::falseVal())->assert(0),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 0 must not evaluate to `false`'),
));
