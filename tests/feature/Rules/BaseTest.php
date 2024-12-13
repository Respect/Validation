<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::base(61)->assert('Z01xSsg5675hic20dj'),
    '"Z01xSsg5675hic20dj" must be a number in base 61',
));

test('Scenario #2', expectFullMessage(
    fn() => v::base(2)->assert(''),
    '- "" must be a number in base 2',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::base(2))->assert('011010001'),
    '"011010001" must not be a number in base 2',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::base(2))->assert('011010001'),
    '- "011010001" must not be a number in base 2',
));
