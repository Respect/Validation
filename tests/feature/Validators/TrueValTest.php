<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::trueVal()->assert(false),
    fn(string $message) => expect($message)->toBe('`false` must evaluate to `true`'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::trueVal())->assert(1),
    fn(string $message) => expect($message)->toBe('1 must not evaluate to `true`'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::trueVal()->assert(0),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 0 must evaluate to `true`'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::trueVal())->assert('true'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "true" must not evaluate to `true`'),
));
