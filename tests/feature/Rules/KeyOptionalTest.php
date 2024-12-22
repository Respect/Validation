<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::keyOptional('foo', v::intType())->assert(['foo' => 'string']),
    'foo must be an integer',
    '- foo must be an integer',
    ['foo' => 'foo must be an integer'],
));

test('Inverted', expectAll(
    fn() => v::not(v::keyOptional('foo', v::intType()))->assert(['foo' => 12]),
    'foo must not be an integer',
    '- foo must not be an integer',
    ['foo' => 'foo must not be an integer'],
));

test('Inverted with missing key', expectAll(
    fn() => v::not(v::keyOptional('foo', v::intType()))->assert([]),
    'foo must be present',
    '- foo must be present',
    ['foo' => 'foo must be present'],
));

test('With wrapped name, default', expectAll(
    fn() => v::keyOptional('foo', v::intType()->setName('Wrapped'))->setName('Wrapper')->assert(['foo' => 'string']),
    'Wrapped must be an integer',
    '- Wrapped must be an integer',
    ['foo' => 'Wrapped must be an integer'],
));

test('With wrapped name, inverted', expectAll(
    fn() => v::not(v::keyOptional('foo', v::intType()->setName('Wrapped'))->setName('Wrapper'))->setName('Not')->assert(['foo' => 12]),
    'Wrapped must not be an integer',
    '- Wrapped must not be an integer',
    ['foo' => 'Wrapped must not be an integer'],
));

test('With wrapper name, default', expectAll(
    fn() => v::keyOptional('foo', v::intType())->setName('Wrapper')->assert(['foo' => 'string']),
    'foo must be an integer',
    '- foo must be an integer',
    ['foo' => 'foo must be an integer'],
));

test('With wrapper name, inverted', expectAll(
    fn() => v::not(v::keyOptional('foo', v::intType())->setName('Wrapper'))->setName('Not')->assert(['foo' => 12]),
    'foo must not be an integer',
    '- foo must not be an integer',
    ['foo' => 'foo must not be an integer'],
));

test('With "Not" name, inverted', expectAll(
    fn() => v::not(v::keyOptional('foo', v::intType()))->setName('Not')->assert(['foo' => 12]),
    'foo must not be an integer',
    '- foo must not be an integer',
    ['foo' => 'foo must not be an integer'],
));

test('With template, default', expectAll(
    fn() => v::keyOptional('foo', v::intType())->assert(['foo' => 'string'], 'That key is off-key'),
    'That key is off-key',
    '- That key is off-key',
    ['foo' => 'That key is off-key'],
));

test('With template, inverted', expectAll(
    fn() => v::not(v::keyOptional('foo', v::intType()))->assert(['foo' => 12], 'No off-key key'),
    'No off-key key',
    '- No off-key key',
    ['foo' => 'No off-key key'],
));
