<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::lazy(fn() => v::intType())->assert(true),
    '`true` must be an integer',
    '- `true` must be an integer',
    ['intType' => '`true` must be an integer'],
));

test('Inverted', expectAll(
    fn() => v::not(v::lazy(fn() => v::intType()))->assert(2),
    '2 must not be an integer',
    '- 2 must not be an integer',
    ['notIntType' => '2 must not be an integer'],
));

test('With created name, default', expectAll(
    fn() => v::lazy(fn() => v::intType()->setName('Created'))->setName('Wrapper')->assert(true),
    'Created must be an integer',
    '- Created must be an integer',
    ['intType' => 'Created must be an integer'],
));

test('With wrapper name, default', expectAll(
    fn() => v::lazy(fn() => v::intType())->setName('Wrapper')->assert(true),
    'Wrapper must be an integer',
    '- Wrapper must be an integer',
    ['intType' => 'Wrapper must be an integer'],
));

test('With created name, inverted', expectAll(
    fn() => v::not(v::lazy(fn() => v::intType()->setName('Created'))->setName('Wrapped'))->setName('Not')->assert(2),
    'Created must not be an integer',
    '- Created must not be an integer',
    ['notIntType' => 'Created must not be an integer'],
));

test('With wrapper name, inverted', expectAll(
    fn() => v::not(v::lazy(fn() => v::intType())->setName('Wrapped'))->setName('Not')->assert(2),
    'Wrapped must not be an integer',
    '- Wrapped must not be an integer',
    ['notIntType' => 'Wrapped must not be an integer'],
));

test('With not name, inverted', expectAll(
    fn() => v::not(v::lazy(fn() => v::intType()))->setName('Not')->assert(2),
    'Not must not be an integer',
    '- Not must not be an integer',
    ['notIntType' => 'Not must not be an integer'],
));

test('With template, default', expectAll(
    fn() => v::lazy(fn() => v::intType())->assert(true, 'Lazy lizards lounging like lords in the local lagoon'),
    'Lazy lizards lounging like lords in the local lagoon',
    '- Lazy lizards lounging like lords in the local lagoon',
    ['intType' => 'Lazy lizards lounging like lords in the local lagoon'],
));
