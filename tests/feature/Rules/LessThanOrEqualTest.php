<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::lessThanOrEqual(10)->assert(11),
    '11 must be less than or equal to 10',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::lessThanOrEqual(10))->assert(5),
    '5 must be greater than 10',
));

test('Scenario #3', expectFullMessage(
    fn() => v::lessThanOrEqual('today')->assert('tomorrow'),
    '- "tomorrow" must be less than or equal to "today"',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::lessThanOrEqual('b'))->assert('a'),
    '- "a" must be greater than "b"',
));
