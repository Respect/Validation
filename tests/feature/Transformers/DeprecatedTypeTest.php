<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessageAndError(
    fn() => v::type('array')->assert(1),
    '1 must be an array',
    'The type() rule is deprecated and will be removed in the next major version. Use arrayType() instead.',
));

test('Scenario #2', expectMessageAndError(
    fn() => v::type('bool')->assert(1),
    '1 must be a boolean',
    'The type() rule is deprecated and will be removed in the next major version. Use boolType() instead.',
));

test('Scenario #3', expectMessageAndError(
    fn() => v::type('boolean')->assert(1),
    '1 must be a boolean',
    'The type() rule is deprecated and will be removed in the next major version. Use boolType() instead.',
));

test('Scenario #4', expectMessageAndError(
    fn() => v::type('callable')->assert(1),
    '1 must be a callable',
    'The type() rule is deprecated and will be removed in the next major version. Use callableType() instead.',
));

test('Scenario #5', expectMessageAndError(
    fn() => v::type('double')->assert(1),
    '1 must be float',
    'The type() rule is deprecated and will be removed in the next major version. Use floatType() instead.',
));

test('Scenario #6', expectMessageAndError(
    fn() => v::type('float')->assert(1),
    '1 must be float',
    'The type() rule is deprecated and will be removed in the next major version. Use floatType() instead.',
));

test('Scenario #7', expectMessageAndError(
    fn() => v::type('int')->assert('1'),
    '"1" must be an integer',
    'The type() rule is deprecated and will be removed in the next major version. Use intType() instead.',
));

test('Scenario #8', expectMessageAndError(
    fn() => v::type('integer')->assert('1'),
    '"1" must be an integer',
    'The type() rule is deprecated and will be removed in the next major version. Use intType() instead.',
));

test('Scenario #9', expectMessageAndError(
    fn() => v::type('null')->assert(1),
    '1 must be null',
    'The type() rule is deprecated and will be removed in the next major version. Use nullType() instead.',
));

test('Scenario #10', expectMessageAndError(
    fn() => v::type('object')->assert(1),
    '1 must be an object',
    'The type() rule is deprecated and will be removed in the next major version. Use objectType() instead.',
));

test('Scenario #11', expectMessageAndError(
    fn() => v::type('resource')->assert(1),
    '1 must be a resource',
    'The type() rule is deprecated and will be removed in the next major version. Use resourceType() instead.',
));

test('Scenario #12', expectMessageAndError(
    fn() => v::type('string')->assert(1),
    '1 must be a string',
    'The type() rule is deprecated and will be removed in the next major version. Use stringType() instead.',
));
