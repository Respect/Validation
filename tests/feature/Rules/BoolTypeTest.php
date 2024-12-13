<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::boolType()->assert('teste'),
    '"teste" must be a boolean',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::boolType())->assert(true),
    '`true` must not be a boolean',
));

test('Scenario #3', expectFullMessage(
    fn() => v::boolType()->assert([]),
    '- `[]` must be a boolean',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::boolType())->assert(false),
    '- `false` must not be a boolean',
));
