<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::notEmpty()->assert(null),
    '`null` must not be empty',
));

test('Scenario #2', expectMessage(
    fn() => v::notEmpty()->setName('Field')->assert(null),
    'Field must not be empty',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::notEmpty())->assert(1),
    '1 must be empty',
));

test('Scenario #4', expectFullMessage(
    fn() => v::notEmpty()->assert(''),
    '- "" must not be empty',
));

test('Scenario #5', expectFullMessage(
    fn() => v::notEmpty()->setName('Field')->assert(''),
    '- Field must not be empty',
));

test('Scenario #6', expectFullMessage(
    fn() => v::not(v::notEmpty())->assert([1]),
    '- `[1]` must be empty',
));
