<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::equivalent(true)->assert(false),
    '`false` must be equivalent to `true`',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::equivalent('Something'))->assert('someThing'),
    '"someThing" must not be equivalent to "Something"',
));

test('Scenario #3', expectFullMessage(
    fn() => v::equivalent(123)->assert('true'),
    '- "true" must be equivalent to 123',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::equivalent(true))->assert(1),
    '- 1 must not be equivalent to `true`',
));
