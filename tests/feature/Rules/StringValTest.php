<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::stringVal()->assert([]),
    '`[]` must be a string value',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::stringVal())->assert(true),
    '`true` must not be a string value',
));

test('Scenario #3', expectFullMessage(
    fn() => v::stringVal()->assert(new stdClass()),
    '- `stdClass {}` must be a string value',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::stringVal())->assert(42),
    '- 42 must not be a string value',
));
