<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::resourceType()->assert('test'),
    '"test" must be a resource',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::resourceType())->assert(tmpfile()),
    '`resource <stream>` must not be a resource',
));

test('Scenario #3', expectFullMessage(
    fn() => v::resourceType()->assert([]),
    '- `[]` must be a resource',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::resourceType())->assert(tmpfile()),
    '- `resource <stream>` must not be a resource',
));
