<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::iterableType()->assert(null),
    '`null` must be iterable',
    '- `null` must be iterable',
    ['iterableType' => '`null` must be iterable']
));

test('Inverted', expectAll(
    fn() => v::not(v::iterableType())->assert([1, 2, 3]),
    '`[1, 2, 3]` must not iterable',
    '- `[1, 2, 3]` must not iterable',
    ['notIterableType' => '`[1, 2, 3]` must not iterable']
));

test('With template', expectAll(
    fn() => v::iterableType()->assert(null, 'Not an iterable at all'),
    'Not an iterable at all',
    '- Not an iterable at all',
    ['iterableType' => 'Not an iterable at all']
));

test('With name', expectAll(
    fn() => v::iterableType()->setName('Options')->assert(null),
    'Options must be iterable',
    '- Options must be iterable',
    ['iterableType' => 'Options must be iterable']
));
