<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::digit()->assert('abc'),
    '"abc" must contain only digits (0-9)',
));

test('Scenario #2', expectMessage(
    fn() => v::digit('-')->assert('a-b'),
    '"a-b" must contain only digits (0-9) and "-"',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::digit())->assert('123'),
    '"123" must not contain digits (0-9)',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::digit('-'))->assert('1-3'),
    '"1-3" must not contain digits (0-9) and "-"',
));

test('Scenario #5', expectFullMessage(
    fn() => v::digit()->assert('abc'),
    '- "abc" must contain only digits (0-9)',
));

test('Scenario #6', expectFullMessage(
    fn() => v::digit('-')->assert('a-b'),
    '- "a-b" must contain only digits (0-9) and "-"',
));

test('Scenario #7', expectFullMessage(
    fn() => v::not(v::digit())->assert('123'),
    '- "123" must not contain digits (0-9)',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::digit('-'))->assert('1-3'),
    '- "1-3" must not contain digits (0-9) and "-"',
));
