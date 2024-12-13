<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::punct()->assert('a'),
    '"a" must contain only punctuation characters',
));

test('Scenario #2', expectMessage(
    fn() => v::punct('c')->assert('b'),
    '"b" must contain only punctuation characters and "c"',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::punct())->assert('.'),
    '"." must not contain punctuation characters',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::punct('d'))->assert('?'),
    '"?" must not contain punctuation characters or "d"',
));

test('Scenario #5', expectFullMessage(
    fn() => v::punct()->assert('e'),
    '- "e" must contain only punctuation characters',
));

test('Scenario #6', expectFullMessage(
    fn() => v::punct('f')->assert('g'),
    '- "g" must contain only punctuation characters and "f"',
));

test('Scenario #7', expectFullMessage(
    fn() => v::not(v::punct())->assert('!'),
    '- "!" must not contain punctuation characters',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::punct('h'))->assert(';'),
    '- ";" must not contain punctuation characters or "h"',
));
