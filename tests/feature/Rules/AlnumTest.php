<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::alnum()->assert('abc%1'),
    '"abc%1" must contain only letters (a-z) and digits (0-9)',
));

test('Scenario #2', expectMessage(
    fn() => v::alnum(' ')->assert('abc%2'),
    '"abc%2" must contain only letters (a-z), digits (0-9), and " "',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::alnum())->assert('abcd3'),
    '"abcd3" must not contain letters (a-z) or digits (0-9)',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::alnum('% '))->assert('abc%4'),
    '"abc%4" must not contain letters (a-z), digits (0-9), or "% "',
));

test('Scenario #5', expectFullMessage(
    fn() => v::alnum()->assert('abc^1'),
    '- "abc^1" must contain only letters (a-z) and digits (0-9)',
));

test('Scenario #6', expectFullMessage(
    fn() => v::not(v::alnum())->assert('abcd2'),
    '- "abcd2" must not contain letters (a-z) or digits (0-9)',
));

test('Scenario #7', expectFullMessage(
    fn() => v::alnum('* &%')->assert('abc^3'),
    '- "abc^3" must contain only letters (a-z), digits (0-9), and "* &%"',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::alnum('^'))->assert('abc^4'),
    '- "abc^4" must not contain letters (a-z), digits (0-9), or "^"',
));
