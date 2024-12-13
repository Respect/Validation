<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::notBlank()->assert(null),
    'The value must not be blank',
));

test('Scenario #2', expectMessage(
    fn() => v::notBlank()->setName('Field')->assert(null),
    'Field must not be blank',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::notBlank())->assert(1),
    '1 must be blank',
));

test('Scenario #4', expectFullMessage(
    fn() => v::notBlank()->assert(''),
    '- The value must not be blank',
));

test('Scenario #5', expectFullMessage(
    fn() => v::notBlank()->setName('Field')->assert(''),
    '- Field must not be blank',
));

test('Scenario #6', expectFullMessage(
    fn() => v::not(v::notBlank())->assert([1]),
    '- `[1]` must be blank',
));
