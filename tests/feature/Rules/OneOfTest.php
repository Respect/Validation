<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default: fail, fail', expectAll(
    fn() => v::oneOf(v::intType(), v::negative())->assert('string'),
    '"string" must be an integer',
    <<<'FULL_MESSAGE'
    - "string" must pass one of the rules
      - "string" must be an integer
      - "string" must be a negative number
    FULL_MESSAGE,
    [
        '__root__' => '"string" must pass one of the rules',
        'intType' => '"string" must be an integer',
        'negative' => '"string" must be a negative number',
    ],
));

test('Default: fail, pass, pass', expectAll(
    fn() => v::oneOf(v::intType(), v::stringType(), v::alpha())->assert('string'),
    '"string" must be an integer',
    <<<'FULL_MESSAGE'
    - "string" must pass only one of the rules
      - "string" must be an integer
      - "string" must be a string
      - "string" must contain only letters (a-z)
    FULL_MESSAGE,
    [
        '__root__' => '"string" must pass only one of the rules',
        'intType' => '"string" must be an integer',
        'stringType' => '"string" must be a string',
        'alpha' => '"string" must contain only letters (a-z)',
    ],
));

test('Default: pass, fail, pass', expectAll(
    fn() => v::oneOf(v::stringType(), v::intType(), v::alpha())->assert('string'),
    '"string" must be an integer',
    <<<'FULL_MESSAGE'
    - "string" must pass only one of the rules
      - "string" must be an integer
      - "string" must be a string
      - "string" must contain only letters (a-z)
    FULL_MESSAGE,
    [
        '__root__' => '"string" must pass only one of the rules',
        'intType' => '"string" must be an integer',
        'stringType' => '"string" must be a string',
        'alpha' => '"string" must contain only letters (a-z)',
    ],
));

test('Default: pass, pass, fail', expectAll(
    fn() => v::oneOf(v::stringType(), v::alpha(), v::intType())->assert('string'),
    '"string" must be an integer',
    <<<'FULL_MESSAGE'
    - "string" must pass only one of the rules
      - "string" must be an integer
      - "string" must be a string
      - "string" must contain only letters (a-z)
    FULL_MESSAGE,
    [
        '__root__' => '"string" must pass only one of the rules',
        'intType' => '"string" must be an integer',
        'stringType' => '"string" must be a string',
        'alpha' => '"string" must contain only letters (a-z)',
    ],
));

test('Inverted: fail, pass', expectAll(
    fn() => v::not(v::oneOf(v::intType(), v::positive()))->assert(-1),
    '-1 must not be an integer',
    '- -1 must not be an integer',
    [
        'intType' => '-1 must not be an integer',
    ],
));

test('Inverted: fail, fail, pass', expectAll(
    fn() => v::not(v::oneOf(v::stringType(), v::alpha(), v::negative()))->assert(-1),
    '-1 must not be a negative number',
    '- -1 must not be a negative number',
    [
        'negative' => '-1 must not be a negative number',
    ],
));
