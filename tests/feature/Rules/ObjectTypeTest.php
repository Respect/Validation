<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::objectType()->assert([]),
    '`[]` must be an object',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::objectType())->assert(new stdClass()),
    '`stdClass {}` must not be an object',
));

test('Scenario #3', expectFullMessage(
    fn() => v::objectType()->assert('test'),
    '- `test(?string $description = null, ?Closure $closure = null): Pest\\Support\\HigherOrderTapProxy|Pest\\PendingCalls\\Te ...` must be an object',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::objectType())->assert(new ArrayObject()),
    '- `ArrayObject { getArrayCopy() => [] }` must not be an object',
));
