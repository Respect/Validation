<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Calling allOf without any arguments', expectDeprecation(
    fn() => v::allOf()->assert('input'),
    'Calling allOf() without any arguments has been deprecated, and will be not be allowed in the next major version. Use it with at least 2 arguments.',
));

test('Calling allOf with a single passing rule as argument', expectDeprecation(
    fn() => v::allOf(v::stringType())->assert('input'),
    'Calling allOf() with a single argument has been deprecated, and will be not be allowed in the next major version. Use it with at least 2 arguments.',
));

test('Calling allOf with a single failing rule as argument', expectMessageAndDeprecation(
    fn() => v::allOf(v::intType())->assert('input'),
    '"input" must be an integer',
    'Calling allOf() with a single argument has been deprecated, and will be not be allowed in the next major version. Use it with at least 2 arguments.',
));

test('Calling anyOf without any arguments', expectMessageAndDeprecation(
    fn() => v::anyOf()->assert('input'),
    '"input" must be valid',
    'Calling anyOf() without any arguments has been deprecated, and will be not be allowed in the next major version. Use it with at least 2 arguments.',
));

test('Calling anyOf with a single passing rule as argument', expectDeprecation(
    fn() => v::anyOf(v::stringType())->assert('input'),
    'Calling anyOf() with a single argument has been deprecated, and will be not be allowed in the next major version. Use it with at least 2 arguments.',
));

test('Calling anyOf with a single failing rule as argument', expectMessageAndDeprecation(
    fn() => v::anyOf(v::intType())->assert('input'),
    '"input" must be an integer',
    'Calling anyOf() with a single argument has been deprecated, and will be not be allowed in the next major version. Use it with at least 2 arguments.',
));

test('Calling noneOf without any arguments', expectDeprecation(
    fn() => v::noneOf()->assert('input'),
    'Calling noneOf() without any arguments has been deprecated, and will be not be allowed in the next major version. Use it with at least 2 arguments.',
));

test('Calling noneOf with a single passing rule as argument', expectMessageAndDeprecation(
    fn() => v::noneOf(v::stringType())->assert('input'),
    '"input" must not be a string',
    'Calling noneOf() with a single argument has been deprecated, and will be not be allowed in the next major version. Use it with at least 2 arguments.',
));

test('Calling noneOf with a single failing rule as argument', expectDeprecation(
    fn() => v::noneOf(v::intType())->assert('input'),
    'Calling noneOf() with a single argument has been deprecated, and will be not be allowed in the next major version. Use it with at least 2 arguments.',
));

test('Calling oneOf without any arguments', expectMessageAndDeprecation(
    fn() => v::oneOf()->assert('input'),
    '"input" must be valid',
    'Calling oneOf() without any arguments has been deprecated, and will be not be allowed in the next major version. Use it with at least 2 arguments.',
));

test('Calling oneOf with a single passing rule as argument', expectDeprecation(
    fn() => v::oneOf(v::stringType())->assert('input'),
    'Calling oneOf() with a single argument has been deprecated, and will be not be allowed in the next major version. Use it with at least 2 arguments.',
));

test('Calling oneOf with a single failing rule as argument', expectMessageAndDeprecation(
    fn() => v::oneOf(v::intType())->assert('input'),
    '"input" must be an integer',
    'Calling oneOf() with a single argument has been deprecated, and will be not be allowed in the next major version. Use it with at least 2 arguments.',
));
