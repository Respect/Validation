<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::arrayVal()->assert('Bla %123'),
    fn(string $message) => expect($message)->toBe('"Bla %123" must be an array value'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::arrayVal())->assert([42]),
    fn(string $message) => expect($message)->toBe('`[42]` must not be an array value'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::arrayVal()->assert(new stdClass()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `stdClass {}` must be an array value'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::arrayVal())->assert(new ArrayObject([2, 3])),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `ArrayObject { getArrayCopy() => [2, 3] }` must not be an array value'),
));
