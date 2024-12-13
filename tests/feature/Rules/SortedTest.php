<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::sorted('ASC')->assert([1, 3, 2]),
    '`[1, 3, 2]` must be sorted in ascending order',
));

test('Scenario #2', expectMessage(
    fn() => v::sorted('DESC')->assert([1, 2, 3]),
    '`[1, 2, 3]` must be sorted in descending order',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::sorted('ASC'))->assert([1, 2, 3]),
    '`[1, 2, 3]` must not be sorted in ascending order',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::sorted('DESC'))->assert([3, 2, 1]),
    '`[3, 2, 1]` must not be sorted in descending order',
));

test('Scenario #5', expectFullMessage(
    fn() => v::sorted('ASC')->assert([3, 2, 1]),
    '- `[3, 2, 1]` must be sorted in ascending order',
));

test('Scenario #6', expectFullMessage(
    fn() => v::sorted('DESC')->assert([1, 2, 3]),
    '- `[1, 2, 3]` must be sorted in descending order',
));

test('Scenario #7', expectFullMessage(
    fn() => v::not(v::sorted('ASC'))->assert([1, 2, 3]),
    '- `[1, 2, 3]` must not be sorted in ascending order',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::sorted('DESC'))->assert([3, 2, 1]),
    '- `[3, 2, 1]` must not be sorted in descending order',
));
