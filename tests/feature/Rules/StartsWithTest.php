<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::startsWith('b')->assert(['a', 'b']),
    '`["a", "b"]` must start with "b"',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::startsWith(1.1))->assert([1.1, 2.2]),
    '`[1.1, 2.2]` must not start with 1.1',
));

test('Scenario #3', expectFullMessage(
    fn() => v::startsWith('3.3', true)->assert([3.3, 4.4]),
    '- `[3.3, 4.4]` must start with "3.3"',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::startsWith('c'))->assert(['c', 'd']),
    '- `["c", "d"]` must not start with "c"',
));
