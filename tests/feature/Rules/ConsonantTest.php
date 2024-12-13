<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::consonant()->assert('aeiou'),
    '"aeiou" must only contain consonants',
));

test('Scenario #2', expectMessage(
    fn() => v::consonant('d')->assert('daeiou'),
    '"daeiou" must only contain consonants and "d"',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::consonant())->assert('bcd'),
    '"bcd" must not contain consonants',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::consonant('a'))->assert('abcd'),
    '"abcd" must not contain consonants or "a"',
));

test('Scenario #5', expectFullMessage(
    fn() => v::consonant()->assert('aeiou'),
    '- "aeiou" must only contain consonants',
));

test('Scenario #6', expectFullMessage(
    fn() => v::consonant('d')->assert('daeiou'),
    '- "daeiou" must only contain consonants and "d"',
));

test('Scenario #7', expectFullMessage(
    fn() => v::not(v::consonant())->assert('bcd'),
    '- "bcd" must not contain consonants',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::consonant('a'))->assert('abcd'),
    '- "abcd" must not contain consonants or "a"',
));
