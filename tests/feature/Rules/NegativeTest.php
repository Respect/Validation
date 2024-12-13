<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::negative()->assert(16),
    '16 must be a negative number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::negative())->assert(-10),
    '-10 must not be a negative number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::negative()->assert('a'),
    '- "a" must be a negative number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::negative())->assert('-144'),
    '- "-144" must not be a negative number',
));
