<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::stringType()->assert(42),
    '42 must be a string',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::stringType())->assert('foo'),
    '"foo" must not be a string',
));

test('Scenario #3', expectFullMessage(
    fn() => v::stringType()->assert(true),
    '- `true` must be a string',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::stringType())->assert('bar'),
    '- "bar" must not be a string',
));
