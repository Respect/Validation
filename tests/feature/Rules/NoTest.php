<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::not(v::no())->assert('No'),
    '"No" must not be similar to "No"',
));

test('Scenario #2', expectMessage(
    fn() => v::no()->assert('Yes'),
    '"Yes" must be similar to "No"',
));

test('Scenario #3', expectFullMessage(
    fn() => v::not(v::no())->assert('No'),
    '- "No" must not be similar to "No"',
));

test('Scenario #4', expectFullMessage(
    fn() => v::no()->assert('Yes'),
    '- "Yes" must be similar to "No"',
));
