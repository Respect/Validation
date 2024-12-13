<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::callback('is_string')->assert([]),
    '`[]` must be valid',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::callback('is_string'))->assert('foo'),
    '"foo" must be invalid',
));

test('Scenario #3', expectFullMessage(
    fn() => v::callback('is_string')->assert(true),
    '- `true` must be valid',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::callback('is_string'))->assert('foo'),
    '- "foo" must be invalid',
));
