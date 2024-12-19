<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Key', expectAll(
    fn() => v::keyEquals('foo', 12)->assert(['foo' => 10]),
    'foo must be equal to 12',
    '- foo must be equal to 12',
    ['foo' => 'foo must be equal to 12']
));

test('Length', expectAll(
    fn() => v::lengthGreaterThan(3)->assert('foo'),
    'The length of "foo" must be greater than 3',
    '- The length of "foo" must be greater than 3',
    ['lengthGreaterThan' => 'The length of "foo" must be greater than 3']
));

test('Max', expectAll(
    fn() => v::maxOdd()->assert([1, 2, 3, 4]),
    'The maximum of `[1, 2, 3, 4]` must be an odd number',
    '- The maximum of `[1, 2, 3, 4]` must be an odd number',
    ['maxOdd' => 'The maximum of `[1, 2, 3, 4]` must be an odd number']
));

test('Min', expectAll(
    fn() => v::minEven()->assert([1, 2, 3]),
    'The minimum of `[1, 2, 3]` must be an even number',
    '- The minimum of `[1, 2, 3]` must be an even number',
    ['minEven' => 'The minimum of `[1, 2, 3]` must be an even number']
));

test('Not', expectAll(
    fn() => v::notBetween(1, 3)->assert(2),
    '2 must not be between 1 and 3',
    '- 2 must not be between 1 and 3',
    ['notBetween' => '2 must not be between 1 and 3']
));

test('NullOr', expectAll(
    fn() => v::nullOrBoolType()->assert('string'),
    '"string" must be a boolean or must be null',
    '- "string" must be a boolean or must be null',
    ['nullOrBoolType' => '"string" must be a boolean or must be null']
));

test('Property', expectAll(
    fn() => v::propertyBetween('foo', 1, 3)->assert((object) ['foo' => 5]),
    'foo must be between 1 and 3',
    '- foo must be between 1 and 3',
    ['foo' => 'foo must be between 1 and 3']
));

test('UndefOr', expectAll(
    fn() => v::undefOrUrl()->assert('string'),
    '"string" must be a URL or must be undefined',
    '- "string" must be a URL or must be undefined',
    ['undefOrUrl' => '"string" must be a URL or must be undefined']
));
