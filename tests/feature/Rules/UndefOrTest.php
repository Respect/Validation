<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::undefOr(v::alpha())->assert(1234),
    '1234 must contain only letters (a-z) or must be undefined',
    '- 1234 must contain only letters (a-z) or must be undefined',
    ['undefOrAlpha' => '1234 must contain only letters (a-z) or must be undefined']
));

test('Inverted wrapper', expectAll(
    fn() => v::not(v::undefOr(v::alpha()))->assert('alpha'),
    '"alpha" must not contain letters (a-z) and must not be undefined',
    '- "alpha" must not contain letters (a-z) and must not be undefined',
    ['notUndefOrAlpha' => '"alpha" must not contain letters (a-z) and must not be undefined']
));

test('Inverted wrapped', expectAll(
    fn() => v::undefOr(v::not(v::alpha()))->assert('alpha'),
    '"alpha" must not contain letters (a-z) or must be undefined',
    '- "alpha" must not contain letters (a-z) or must be undefined',
    ['undefOrNotAlpha' => '"alpha" must not contain letters (a-z) or must be undefined']
));

test('Inverted undefined', expectAll(
    fn() => v::not(v::undefOr(v::alpha()))->assert(null),
    '`null` must not contain letters (a-z) and must not be undefined',
    '- `null` must not contain letters (a-z) and must not be undefined',
    ['notUndefOrAlpha' => '`null` must not contain letters (a-z) and must not be undefined']
));

test('Inverted undefined, wrapped name', expectAll(
    fn() => v::not(v::undefOr(v::alpha()->setName('Wrapped')))->assert(null),
    'Wrapped must not contain letters (a-z) and must not be undefined',
    '- Wrapped must not contain letters (a-z) and must not be undefined',
    ['notUndefOrAlpha' => 'Wrapped must not contain letters (a-z) and must not be undefined']
));

test('Inverted undefined, wrapper name', expectAll(
    fn() => v::not(v::undefOr(v::alpha())->setName('Wrapper'))->assert(null),
    'Wrapper must not contain letters (a-z) and must not be undefined',
    '- Wrapper must not contain letters (a-z) and must not be undefined',
    ['notUndefOrAlpha' => 'Wrapper must not contain letters (a-z) and must not be undefined']
));

test('Inverted undefined, not name', expectAll(
    fn() => v::not(v::undefOr(v::alpha()))->setName('Not')->assert(null),
    'Not must not contain letters (a-z) and must not be undefined',
    '- Not must not contain letters (a-z) and must not be undefined',
    ['notUndefOrAlpha' => 'Not must not contain letters (a-z) and must not be undefined']
));

test('With template', expectAll(
    fn() => v::undefOr(v::alpha())->assert(123, 'Underneath the undulating umbrella'),
    'Underneath the undulating umbrella',
    '- Underneath the undulating umbrella',
    ['undefOrAlpha' => 'Underneath the undulating umbrella']
));

test('With array template', expectAll(
    fn() => v::undefOr(v::alpha())->assert(123, ['undefOrAlpha' => 'Undefined number of unique unicorns']),
    'Undefined number of unique unicorns',
    '- Undefined number of unique unicorns',
    ['undefOrAlpha' => 'Undefined number of unique unicorns']
));

test('Inverted undefined with template', expectAll(
    fn() => v::not(v::undefOr(v::alpha()))->assert('', ['notUndefOrAlpha' => 'Should not be undefined or alpha']),
    'Should not be undefined or alpha',
    '- Should not be undefined or alpha',
    ['notUndefOrAlpha' => 'Should not be undefined or alpha']
));

test('Without subsequent result', expectAll(
    fn() => v::undefOr(v::alpha()->stringType())->assert(1234),
    '1234 must contain only letters (a-z) or must be undefined',
    <<<'FULL_MESSAGE'
    - All the required rules must pass for 1234
      - 1234 must contain only letters (a-z) or must be undefined
      - 1234 must be a string or must be undefined
    FULL_MESSAGE,
    [
        '__root__' => 'All the required rules must pass for 1234',
        'undefOrAlpha' => '1234 must contain only letters (a-z) or must be undefined',
        'undefOrStringType' => '1234 must be a string or must be undefined',
    ]
));

test('Without subsequent result with templates', expectAll(
    fn() => v::undefOr(v::alpha()->stringType())->assert(1234, [
        'undefOrAlpha' => 'Should be nul or alpha',
        'undefOrStringType' => 'Should be nul or string type',
    ]),
    'Should be nul or alpha',
    <<<'FULL_MESSAGE'
    - All the required rules must pass for 1234
      - Should be nul or alpha
      - Should be nul or string type
    FULL_MESSAGE,
    [
        '__root__' => 'All the required rules must pass for 1234',
        'undefOrAlpha' => 'Should be nul or alpha',
        'undefOrStringType' => 'Should be nul or string type',
    ]
));
