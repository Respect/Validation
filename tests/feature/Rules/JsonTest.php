<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::json()->assert(false),
    '`false` must be a valid JSON string',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::json())->assert('{"foo": "bar", "number":1}'),
    '"{\\"foo\\": \\"bar\\", \\"number\\":1}" must not be a valid JSON string',
));

test('Scenario #3', expectFullMessage(
    fn() => v::json()->assert(new stdClass()),
    '- `stdClass {}` must be a valid JSON string',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::json())->assert('{}'),
    '- "{}" must not be a valid JSON string',
));
