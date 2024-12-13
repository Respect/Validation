<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::space()->assert('ab'),
    '"ab" must contain only space characters',
));

test('Scenario #2', expectMessage(
    fn() => v::space('c')->assert('cd'),
    '"cd" must contain only space characters and "c"',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::space())->assert("\t"),
    '"\\t" must not contain space characters',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::space('def'))->assert("\r"),
    '"\\r" must not contain space characters or "def"',
));

test('Scenario #5', expectFullMessage(
    fn() => v::space()->assert('ef'),
    '- "ef" must contain only space characters',
));

test('Scenario #6', expectFullMessage(
    fn() => v::space('e')->assert('gh'),
    '- "gh" must contain only space characters and "e"',
));

test('Scenario #7', expectFullMessage(
    fn() => v::not(v::space())->assert("\n"),
    '- "\\n" must not contain space characters',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::space('yk'))->assert(' k'),
    '- " k" must not contain space characters or "yk"',
));
