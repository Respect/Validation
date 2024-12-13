<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::size('1kb', '2kb')->assert('tests/fixtures/valid-image.gif'),
    '"tests/fixtures/valid-image.gif" must be between "1kb" and "2kb"',
));

test('Scenario #2', expectMessage(
    fn() => v::size('700kb', null)->assert('tests/fixtures/valid-image.gif'),
    '"tests/fixtures/valid-image.gif" must be greater than "700kb"',
));

test('Scenario #3', expectMessage(
    fn() => v::size(null, '1kb')->assert('tests/fixtures/valid-image.gif'),
    '"tests/fixtures/valid-image.gif" must be lower than "1kb"',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::size('500kb', '600kb'))->assert('tests/fixtures/valid-image.gif'),
    '"tests/fixtures/valid-image.gif" must not be between "500kb" and "600kb"',
));

test('Scenario #5', expectMessage(
    fn() => v::not(v::size('500kb', null))->assert('tests/fixtures/valid-image.gif'),
    '"tests/fixtures/valid-image.gif" must not be greater than "500kb"',
));

test('Scenario #6', expectMessage(
    fn() => v::not(v::size(null, '600kb'))->assert('tests/fixtures/valid-image.gif'),
    '"tests/fixtures/valid-image.gif" must not be lower than "600kb"',
));

test('Scenario #7', expectFullMessage(
    fn() => v::size('1kb', '2kb')->assert('tests/fixtures/valid-image.gif'),
    '- "tests/fixtures/valid-image.gif" must be between "1kb" and "2kb"',
));

test('Scenario #8', expectFullMessage(
    fn() => v::size('700kb', null)->assert('tests/fixtures/valid-image.gif'),
    '- "tests/fixtures/valid-image.gif" must be greater than "700kb"',
));

test('Scenario #9', expectFullMessage(
    fn() => v::size(null, '1kb')->assert('tests/fixtures/valid-image.gif'),
    '- "tests/fixtures/valid-image.gif" must be lower than "1kb"',
));

test('Scenario #10', expectFullMessage(
    fn() => v::not(v::size('500kb', '600kb'))->assert('tests/fixtures/valid-image.gif'),
    '- "tests/fixtures/valid-image.gif" must not be between "500kb" and "600kb"',
));

test('Scenario #11', expectFullMessage(
    fn() => v::not(v::size('500kb', null))->assert('tests/fixtures/valid-image.gif'),
    '- "tests/fixtures/valid-image.gif" must not be greater than "500kb"',
));

test('Scenario #12', expectFullMessage(
    fn() => v::not(v::size(null, '600kb'))->assert('tests/fixtures/valid-image.gif'),
    '- "tests/fixtures/valid-image.gif" must not be lower than "600kb"',
));
