<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default: fail, fail', expectAll(
    fn() => v::allOf(v::intType(), v::negative())->assert('string'),
    '"string" must be an integer',
    <<<'FULL_MESSAGE'
    - "string" must pass all the rules
      - "string" must be an integer
      - "string" must be a negative number
    FULL_MESSAGE,
    [
        '__root__' => '"string" must pass all the rules',
        'intType' => '"string" must be an integer',
        'negative' => '"string" must be a negative number',
    ],
));

test('Default: fail, pass', expectAll(
    fn() => v::allOf(v::intType(), v::stringType())->assert('string'),
    '"string" must be an integer',
    <<<'FULL_MESSAGE'
    - "string" must be an integer
    FULL_MESSAGE,
    [
        'intType' => '"string" must be an integer',
    ],
));

test('Default: fail, fail, pass', expectAll(
    fn() => v::allOf(v::intType(), v::positive(), v::stringType())->assert('string'),
    '"string" must be an integer',
    <<<'FULL_MESSAGE'
    - "string" must pass the rules
      - "string" must be an integer
      - "string" must be a positive number
    FULL_MESSAGE,
    [
        '__root__' => '"string" must pass the rules',
        'intType' => '"string" must be an integer',
        'positive' => '"string" must be a positive number',
    ],
));

test('Inverted: pass, pass', expectAll(
    fn() => v::not(v::allOf(v::intType(), v::negative()))->assert(-1),
    '-1 must not be an integer',
    <<<'FULL_MESSAGE'
    - -1 must pass the rules
      - -1 must not be an integer
      - -1 must not be a negative number
    FULL_MESSAGE,
    [
        '__root__' => '-1 must pass the rules',
        'intType' => '-1 must not be an integer',
        'negative' => '-1 must not be a negative number',
    ],
));

test('Inverted: pass, fail, fail', expectAll(
    fn() => v::allOf(v::intType(), v::alpha(), v::stringType())->assert(2),
    '2 must contain only letters (a-z)',
    <<<'FULL_MESSAGE'
    - 2 must pass the rules
      - 2 must contain only letters (a-z)
      - 2 must be a string
    FULL_MESSAGE,
    [
        '__root__' => '2 must pass the rules',
        'alpha' => '2 must contain only letters (a-z)',
        'stringType' => '2 must be a string',
    ],
));

test('Wrapping "not"', expectAll(
    fn() => v::allOf(v::not(v::intType()), v::greaterThan(2))->assert(4),
    '4 must not be an integer',
    '- 4 must not be an integer',
    ['notIntType' => '4 must not be an integer'],
));

test('With a single template', expectAll(
    fn() => v::allOf(v::stringType(), v::arrayType())->assert(5, 'This is a single template'),
    'This is a single template',
    '- This is a single template',
    ['allOf' => 'This is a single template'],
));

test('With multiple templates', expectAll(
    fn() => v::allOf(v::stringType(), v::uppercase())->assert(5, [
        '__root__' => 'Two things are wrong',
        'stringType' => 'Template for "stringType"',
        'uppercase' => 'Template for "uppercase"',
    ]),
    'Template for "stringType"',
    <<<'FULL_MESSAGE'
    - Two things are wrong
      - Template for "stringType"
      - Template for "uppercase"
    FULL_MESSAGE,
    [
        '__root__' => 'Two things are wrong',
        'stringType' => 'Template for "stringType"',
        'uppercase' => 'Template for "uppercase"',
    ],
));
