<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default: fail, fail', expectAll(
    fn() => v::noneOf(v::intType(), v::negative())->assert(-1),
    '-1 must not be an integer',
    <<<'FULL_MESSAGE'
    - -1 must pass all the rules
      - -1 must not be an integer
      - -1 must not be a negative number
    FULL_MESSAGE,
    [
        '__root__' => '-1 must pass all the rules',
        'intType' => '-1 must not be an integer',
        'negative' => '-1 must not be a negative number',
    ],
));

test('Default: pass, fail', expectAll(
    fn() => v::noneOf(v::intType(), v::stringType())->assert('string'),
    '"string" must not be a string',
    <<<'FULL_MESSAGE'
    - "string" must not be a string
    FULL_MESSAGE,
    [
        'stringType' => '"string" must not be a string',
    ],
));

test('Default: pass, fail, fail', expectAll(
    fn() => v::noneOf(v::intType(), v::alpha(), v::stringType())->assert('string'),
    '"string" must not contain letters (a-z)',
    <<<'FULL_MESSAGE'
    - "string" must pass the rules
      - "string" must not contain letters (a-z)
      - "string" must not be a string
    FULL_MESSAGE,
    [
        '__root__' => '"string" must pass the rules',
        'alpha' => '"string" must not contain letters (a-z)',
        'stringType' => '"string" must not be a string',
    ],
));

test('Inverted: fail, fail', expectAll(
    fn() => v::not(v::noneOf(v::intType(), v::negative()))->assert('string'),
    '"string" must be an integer',
    <<<'FULL_MESSAGE'
    - "string" must pass the rules
      - "string" must be an integer
      - "string" must be a negative number
    FULL_MESSAGE,
    [
        '__root__' => '"string" must pass the rules',
        'intType' => '"string" must be an integer',
        'negative' => '"string" must be a negative number',
    ],
));
