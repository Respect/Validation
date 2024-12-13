<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

test('Scenario #1', expectMessage(
    fn() => v::control()->assert('16-50'),
    '"16-50" must only contain control characters',
));

test('Scenario #2', expectMessage(
    fn() => v::control('16')->assert('16-50'),
    '"16-50" must only contain control characters and "16"',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::control())->assert("\n"),
    '"\\n" must not contain control characters',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::control('16'))->assert("16\n"),
    '"16\\n" must not contain control characters or "16"',
));

test('Scenario #5', expectFullMessage(
    fn() => v::control()->assert('Foo'),
    '- "Foo" must only contain control characters',
));

test('Scenario #6', expectFullMessage(
    fn() => v::control('Bar')->assert('Foo'),
    '- "Foo" must only contain control characters and "Bar"',
));

test('Scenario #7', expectFullMessage(
    fn() => v::not(v::control())->assert("\n"),
    '- "\\n" must not contain control characters',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::control('Bar'))->assert("Bar\n"),
    '- "Bar\\n" must not contain control characters or "Bar"',
));
