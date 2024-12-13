<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::xdigit()->assert('aaa%a'),
    '"aaa%a" must only contain hexadecimal digits',
));

test('Scenario #2', expectMessage(
    fn() => v::xdigit(' ')->assert('bbb%b'),
    '"bbb%b" must contain hexadecimal digits and " "',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::xdigit())->assert('ccccc'),
    '"ccccc" must not only contain hexadecimal digits',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::xdigit('% '))->assert('ddd%d'),
    '"ddd%d" must not contain hexadecimal digits or "% "',
));

test('Scenario #5', expectFullMessage(
    fn() => v::xdigit()->assert('eee^e'),
    '- "eee^e" must only contain hexadecimal digits',
));

test('Scenario #6', expectFullMessage(
    fn() => v::not(v::xdigit())->assert('fffff'),
    '- "fffff" must not only contain hexadecimal digits',
));

test('Scenario #7', expectFullMessage(
    fn() => v::xdigit('* &%')->assert('000^0'),
    '- "000^0" must contain hexadecimal digits and "* &%"',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::xdigit('^'))->assert('111^1'),
    '- "111^1" must not contain hexadecimal digits or "^"',
));
