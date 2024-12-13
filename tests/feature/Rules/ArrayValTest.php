<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::arrayVal()->assert('Bla %123'),
    '"Bla %123" must be an array value',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::arrayVal())->assert([42]),
    '`[42]` must not be an array value',
));

test('Scenario #3', expectFullMessage(
    fn() => v::arrayVal()->assert(new stdClass()),
    '- `stdClass {}` must be an array value',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::arrayVal())->assert(new ArrayObject([2, 3])),
    '- `ArrayObject { getArrayCopy() => [2, 3] }` must not be an array value',
));
