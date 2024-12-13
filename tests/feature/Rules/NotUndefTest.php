<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::notUndef()->assert(null),
    'The value must be defined',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::notUndef())->assert(0),
    'The value must be undefined',
));

test('Scenario #3', expectMessage(
    fn() => v::notUndef()->setName('Field')->assert(null),
    'Field must be defined',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::notUndef()->setName('Field'))->assert([]),
    'Field must be undefined',
));

test('Scenario #5', expectFullMessage(
    fn() => v::notUndef()->assert(''),
    '- The value must be defined',
));

test('Scenario #6', expectFullMessage(
    fn() => v::not(v::notUndef())->assert([]),
    '- The value must be undefined',
));

test('Scenario #7', expectFullMessage(
    fn() => v::notUndef()->setName('Field')->assert(''),
    '- Field must be defined',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::notUndef()->setName('Field'))->assert([]),
    '- Field must be undefined',
));
