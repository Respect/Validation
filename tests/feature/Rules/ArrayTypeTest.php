<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::arrayType()->assert('teste'),
    '"teste" must be an array',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::arrayType())->assert([]),
    '`[]` must not be an array',
));

test('Scenario #3', expectFullMessage(
    fn() => v::arrayType()->assert(new ArrayObject()),
    '- `ArrayObject { getArrayCopy() => [] }` must be an array',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::arrayType())->assert([1, 2, 3]),
    '- `[1, 2, 3]` must not be an array',
));
