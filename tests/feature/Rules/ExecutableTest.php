<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::executable()->assert('bar'),
    '"bar" must be an executable file',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::executable())->assert('tests/fixtures/executable'),
    '"tests/fixtures/executable" must not be an executable file',
));

test('Scenario #3', expectFullMessage(
    fn() => v::executable()->assert('bar'),
    '- "bar" must be an executable file',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::executable())->assert('tests/fixtures/executable'),
    '- "tests/fixtures/executable" must not be an executable file',
));
