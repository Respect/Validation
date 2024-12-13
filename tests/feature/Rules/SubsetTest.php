<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::subset([1, 2])->assert([1, 2, 3]),
    '`[1, 2, 3]` must be subset of `[1, 2]`',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::subset([1, 2, 3]))->assert([1, 2]),
    '`[1, 2]` must not be subset of `[1, 2, 3]`',
));

test('Scenario #3', expectFullMessage(
    fn() => v::subset(['A', 'B'])->assert(['B', 'C']),
    '- `["B", "C"]` must be subset of `["A", "B"]`',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::subset(['A']))->assert(['A']),
    '- `["A"]` must not be subset of `["A"]`',
));
