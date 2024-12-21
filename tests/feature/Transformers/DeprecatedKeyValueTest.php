<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessageAndError(
    fn() => v::keyValue('foo', 'equals', 'bar')->assert(['bar' => 42]),
    '`.foo` must be present',
    'The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead.',
));

test('Scenario #2', expectMessageAndError(
    fn() => v::keyValue('foo', 'equals', 'bar')->assert(['foo' => 42]),
    '`.bar` must be present',
    'The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead.',
));

test('Scenario #3', expectMessageAndError(
    fn() => v::keyValue('foo', 'json', 'bar')->assert(['foo' => 42, 'bar' => 43]),
    '`.bar` must be valid to validate `.foo`',
    'The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead.',
));

test('Scenario #4', expectMessageAndError(
    fn() => v::keyValue('foo', 'equals', 'bar')->assert(['foo' => 1, 'bar' => 2]),
    '`.foo` must be equal to 2',
    'The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead.',
));

test('Scenario #5', expectMessageAndError(
    fn() => v::not(v::keyValue('foo', 'equals', 'bar'))->assert(['foo' => 1, 'bar' => 1]),
    '`.foo` must not be equal to 1',
    'The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead.',
));

test('Scenario #6', expectMessageAndError(
    fn() => v::keyValue('foo', 'equals', 'bar')->assert(['bar' => 42]),
    '`.foo` must be present',
    'The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead.',
));

test('Scenario #7', expectMessageAndError(
    fn() => v::keyValue('foo', 'equals', 'bar')->assert(['foo' => 42]),
    '`.bar` must be present',
    'The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead.',
));

test('Scenario #8', expectMessageAndError(
    fn() => v::keyValue('foo', 'json', 'bar')->assert(['foo' => 42, 'bar' => 43]),
    '`.bar` must be valid to validate `.foo`',
    'The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead.',
));

test('Scenario #9', expectMessageAndError(
    fn() => v::keyValue('foo', 'equals', 'bar')->assert(['foo' => 1, 'bar' => 2]),
    '`.foo` must be equal to 2',
    'The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead.',
));

test('Scenario #10', expectMessageAndError(
    fn() => v::not(v::keyValue('foo', 'equals', 'bar'))->assert(['foo' => 1, 'bar' => 1]),
    '`.foo` must not be equal to 1',
    'The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead.',
));
