<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::countable()->assert(1.0),
    '1.0 must be a countable value',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::countable())->assert([]),
    '`[]` must not be a countable value',
));

test('Scenario #3', expectFullMessage(
    fn() => v::countable()->assert('Not countable!'),
    '- "Not countable!" must be a countable value',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::countable())->assert(new ArrayObject()),
    '- `ArrayObject { getArrayCopy() => [] }` must not be a countable value',
));
