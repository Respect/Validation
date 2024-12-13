<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::alpha()->assert('aaa%a'),
    '"aaa%a" must contain only letters (a-z)',
));

test('Scenario #2', expectMessage(
    fn() => v::alpha(' ')->assert('bbb%b'),
    '"bbb%b" must contain only letters (a-z) and " "',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::alpha())->assert('ccccc'),
    '"ccccc" must not contain letters (a-z)',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::alpha('% '))->assert('ddd%d'),
    '"ddd%d" must not contain letters (a-z) or "% "',
));

test('Scenario #5', expectFullMessage(
    fn() => v::alpha()->assert('eee^e'),
    '- "eee^e" must contain only letters (a-z)',
));

test('Scenario #6', expectFullMessage(
    fn() => v::not(v::alpha())->assert('fffff'),
    '- "fffff" must not contain letters (a-z)',
));

test('Scenario #7', expectFullMessage(
    fn() => v::alpha('* &%')->assert('ggg^g'),
    '- "ggg^g" must contain only letters (a-z) and "* &%"',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::alpha('^'))->assert('hhh^h'),
    '- "hhh^h" must not contain letters (a-z) or "^"',
));
