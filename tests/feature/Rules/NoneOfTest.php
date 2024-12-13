<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::noneOf(v::intType(), v::positive())->assert(42),
    '42 must not be an integer',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::noneOf(v::intType(), v::positive()))->assert('-1'),
    '"-1" must be an integer',
));

test('Scenario #3', expectFullMessage(
    fn() => v::noneOf(v::intType(), v::positive())->assert(42),
    <<<'FULL_MESSAGE'
    - None of these rules must pass for 42
      - 42 must not be an integer
      - 42 must not be a positive number
    FULL_MESSAGE,
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::noneOf(v::intType(), v::positive()))->assert('-1'),
    <<<'FULL_MESSAGE'
- All of these rules must pass for "-1"
  - "-1" must be an integer
  - "-1" must be a positive number
FULL_MESSAGE,
));
