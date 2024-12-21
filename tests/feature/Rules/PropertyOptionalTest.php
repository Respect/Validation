<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::propertyOptional('foo', v::intType())->assert((object) ['foo' => 'string']),
    '`.foo` must be an integer',
    '- `.foo` must be an integer',
    ['foo' => '`.foo` must be an integer'],
));

test('Inverted', expectAll(
    fn() => v::not(v::propertyOptional('foo', v::intType()))->assert((object) ['foo' => 12]),
    '`.foo` must not be an integer',
    '- `.foo` must not be an integer',
    ['foo' => '`.foo` must not be an integer'],
));

test('Inverted with missing property', expectAll(
    fn() => v::not(v::propertyOptional('foo', v::intType()))->assert(new stdClass()),
    '`.foo` must be present',
    '- `.foo` must be present',
    ['foo' => '`.foo` must be present'],
));

test('With wrapped name, default', expectAll(
    fn() => v::propertyOptional('foo', v::intType()->setName('Wrapped'))->setName('Wrapper')->assert((object) ['foo' => 'string']),
    'Wrapped must be an integer',
    '- Wrapped must be an integer',
    ['foo' => 'Wrapped must be an integer'],
));

test('With wrapped name, inverted', expectAll(
    fn() => v::not(v::propertyOptional('foo', v::intType()->setName('Wrapped'))->setName('Wrapper'))->setName('Not')->assert((object) ['foo' => 12]),
    'Wrapped must not be an integer',
    '- Wrapped must not be an integer',
    ['foo' => 'Wrapped must not be an integer'],
));

test('With wrapper name, default', expectAll(
    fn() => v::propertyOptional('foo', v::intType())->setName('Wrapper')->assert((object) ['foo' => 'string']),
    'Wrapper must be an integer',
    '- Wrapper must be an integer',
    ['foo' => 'Wrapper must be an integer'],
));

test('With wrapper name, inverted', expectAll(
    fn() => v::not(v::propertyOptional('foo', v::intType())->setName('Wrapper'))->setName('Not')->assert((object) ['foo' => 12]),
    'Wrapper must not be an integer',
    '- Wrapper must not be an integer',
    ['foo' => 'Wrapper must not be an integer'],
));

test('With "Not" name, inverted', expectAll(
    fn() => v::not(v::propertyOptional('foo', v::intType()))->setName('Not')->assert((object) ['foo' => 12]),
    'Not must not be an integer',
    '- Not must not be an integer',
    ['foo' => 'Not must not be an integer'],
));

test('With template, default', expectAll(
    fn() => v::propertyOptional('foo', v::intType())
        ->assert((object) ['foo' => 'string'], 'Proper property planners plan precise property plots'),
    'Proper property planners plan precise property plots',
    '- Proper property planners plan precise property plots',
    ['foo' => 'Proper property planners plan precise property plots'],
));

test('With template, inverted', expectAll(
    fn() => v::not(v::propertyOptional('foo', v::intType()))
        ->assert((object) ['foo' => 12], 'Not proving prudent property planning promotes prosperity'),
    'Not proving prudent property planning promotes prosperity',
    '- Not proving prudent property planning promotes prosperity',
    ['foo' => 'Not proving prudent property planning promotes prosperity'],
));
