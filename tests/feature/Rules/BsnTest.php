<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::bsn()->assert('acb'),
    '"acb" must be a valid BSN',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::bsn())->assert('612890053'),
    '"612890053" must not be a valid BSN',
));

test('Scenario #3', expectFullMessage(
    fn() => v::bsn()->assert('abc'),
    '- "abc" must be a valid BSN',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::bsn())->assert('612890053'),
    '- "612890053" must not be a valid BSN',
));
