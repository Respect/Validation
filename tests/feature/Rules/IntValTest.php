<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::intVal()->assert('42.33'),
    '"42.33" must be an integer value',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::intVal())->assert(2),
    '2 must not be an integer value',
));

test('Scenario #3', expectFullMessage(
    fn() => v::intVal()->assert('Foo'),
    '- "Foo" must be an integer value',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::intVal())->assert(3),
    '- 3 must not be an integer value',
));

test('Scenario #5', expectFullMessage(
    fn() => v::not(v::intVal())->assert(-42),
    '- -42 must not be an integer value',
));

test('Scenario #6', expectFullMessage(
    fn() => v::not(v::intVal())->assert('-42'),
    '- "-42" must not be an integer value',
));
