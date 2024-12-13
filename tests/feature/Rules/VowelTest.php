<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::vowel()->assert('b'),
    '"b" must consist of vowels only',
));

test('Scenario #2', expectMessage(
    fn() => v::vowel('c')->assert('d'),
    '"d" must consist of vowels and "c"',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::vowel())->assert('a'),
    '"a" must not consist of vowels only',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::vowel('f'))->assert('e'),
    '"e" must not consist of vowels or "f"',
));

test('Scenario #5', expectFullMessage(
    fn() => v::vowel()->assert('g'),
    '- "g" must consist of vowels only',
));

test('Scenario #6', expectFullMessage(
    fn() => v::vowel('h')->assert('j'),
    '- "j" must consist of vowels and "h"',
));

test('Scenario #7', expectFullMessage(
    fn() => v::not(v::vowel())->assert('i'),
    '- "i" must not consist of vowels only',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::vowel('k'))->assert('o'),
    '- "o" must not consist of vowels or "k"',
));
