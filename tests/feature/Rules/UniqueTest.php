<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::unique()->assert([1, 2, 2, 3]),
    '`[1, 2, 2, 3]` must not contain duplicates',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::unique())->assert([1, 2, 3, 4]),
    '`[1, 2, 3, 4]` must contain duplicates',
));

test('Scenario #3', expectFullMessage(
    fn() => v::unique()->assert('test'),
    '- "test" must not contain duplicates',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::unique())->assert(['a', 'b', 'c']),
    '- `["a", "b", "c"]` must contain duplicates',
));
