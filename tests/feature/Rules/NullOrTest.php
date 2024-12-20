<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::nullOr(v::alpha())->assert(1234),
    '1234 must contain only letters (a-z) or must be null',
    '- 1234 must contain only letters (a-z) or must be null',
    ['nullOrAlpha' => '1234 must contain only letters (a-z) or must be null']
));

test('Inverted wrapper', expectAll(
    fn() => v::not(v::nullOr(v::alpha()))->assert('alpha'),
    '"alpha" must not contain letters (a-z) and must not be null',
    '- "alpha" must not contain letters (a-z) and must not be null',
    ['notNullOrAlpha' => '"alpha" must not contain letters (a-z) and must not be null']
));

test('Inverted wrapped', expectAll(
    fn() => v::nullOr(v::not(v::alpha()))->assert('alpha'),
    '"alpha" must not contain letters (a-z) or must be null',
    '- "alpha" must not contain letters (a-z) or must be null',
    ['nullOrNotAlpha' => '"alpha" must not contain letters (a-z) or must be null']
));

test('Inverted nullined', expectAll(
    fn() => v::not(v::nullOr(v::alpha()))->assert(null),
    '`null` must not contain letters (a-z) and must not be null',
    '- `null` must not contain letters (a-z) and must not be null',
    ['notNullOrAlpha' => '`null` must not contain letters (a-z) and must not be null']
));

test('Inverted nullined, wrapped name', expectAll(
    fn() => v::not(v::nullOr(v::alpha()->setName('Wrapped')))->assert(null),
    'Wrapped must not contain letters (a-z) and must not be null',
    '- Wrapped must not contain letters (a-z) and must not be null',
    ['notNullOrAlpha' => 'Wrapped must not contain letters (a-z) and must not be null']
));

test('Inverted nullined, wrapper name', expectAll(
    fn() => v::not(v::nullOr(v::alpha())->setName('Wrapper'))->assert(null),
    'Wrapper must not contain letters (a-z) and must not be null',
    '- Wrapper must not contain letters (a-z) and must not be null',
    ['notNullOrAlpha' => 'Wrapper must not contain letters (a-z) and must not be null']
));

test('Inverted nullined, not name', expectAll(
    fn() => v::not(v::nullOr(v::alpha()))->setName('Not')->assert(null),
    'Not must not contain letters (a-z) and must not be null',
    '- Not must not contain letters (a-z) and must not be null',
    ['notNullOrAlpha' => 'Not must not contain letters (a-z) and must not be null']
));

test('With template', expectAll(
    fn() => v::nullOr(v::alpha())->assert(123, 'Nine nimble numismatists near Naples'),
    'Nine nimble numismatists near Naples',
    '- Nine nimble numismatists near Naples',
    ['nullOrAlpha' => 'Nine nimble numismatists near Naples']
));

test('With array template', expectAll(
    fn() => v::nullOr(v::alpha())->assert(123, ['nullOrAlpha' => 'Next to nifty null notations']),
    'Next to nifty null notations',
    '- Next to nifty null notations',
    ['nullOrAlpha' => 'Next to nifty null notations']
));

test('Inverted nullined with template', expectAll(
    fn() => v::not(v::nullOr(v::alpha()))->assert(null, ['notNullOrAlpha' => 'Next to nifty null notations']),
    'Next to nifty null notations',
    '- Next to nifty null notations',
    ['notNullOrAlpha' => 'Next to nifty null notations']
));

test('Without adjacent result', expectAll(
    fn() => v::nullOr(v::alpha()->stringType())->assert(1234),
    '1234 must contain only letters (a-z) or must be null',
    <<<'FULL_MESSAGE'
    - All the required rules must pass for 1234
      - 1234 must contain only letters (a-z) or must be null
      - 1234 must be a string or must be null
    FULL_MESSAGE,
    [
        '__root__' => 'All the required rules must pass for 1234',
        'nullOrAlpha' => '1234 must contain only letters (a-z) or must be null',
        'nullOrStringType' => '1234 must be a string or must be null',
    ]
));

test('Without adjacent result with templates', expectAll(
    fn() => v::nullOr(v::alpha()->stringType())->assert(1234, [
        'nullOrAlpha' => 'Should be nul or alpha',
        'nullOrStringType' => 'Should be nul or string type',
    ]),
    'Should be nul or alpha',
    <<<'FULL_MESSAGE'
    - All the required rules must pass for 1234
      - Should be nul or alpha
      - Should be nul or string type
    FULL_MESSAGE,
    [
        '__root__' => 'All the required rules must pass for 1234',
        'nullOrAlpha' => 'Should be nul or alpha',
        'nullOrStringType' => 'Should be nul or string type',
    ]
));
