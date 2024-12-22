<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Two rules', expectAll(
    fn() => v::allOf(v::intType(), v::negative())->assert('2'),
    '"2" must be an integer',
    <<<'FULL_MESSAGE'
    - All the required rules must pass for "2"
      - "2" must be an integer
      - "2" must be a negative number
    FULL_MESSAGE,
    [
        '__root__' => 'All the required rules must pass for "2"',
        'intType' => '"2" must be an integer',
        'negative' => '"2" must be a negative number',
    ],
));

test('Wrapped by "not"', expectAll(
    fn() => v::not(v::allOf(v::intType(), v::positive()))->assert(3),
    '3 must not be an integer',
    <<<'FULL_MESSAGE'
    - These rules must not pass for 3
      - 3 must not be an integer
      - 3 must not be a positive number
    FULL_MESSAGE,
    [
        '__root__' => 'These rules must not pass for 3',
        'intType' => '3 must not be an integer',
        'positive' => '3 must not be a positive number',
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
