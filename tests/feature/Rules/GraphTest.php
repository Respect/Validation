<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::graph()->assert("foo\nbar"),
    '"foo\\nbar" must contain only graphical characters',
));

test('Scenario #2', expectMessage(
    fn() => v::graph('foo')->assert("foo\nbar"),
    '"foo\\nbar" must contain only graphical characters and "foo"',
));

test('Scenario #3', expectMessage(
    fn() => v::not(v::graph())->assert('foobar'),
    '"foobar" must not contain graphical characters',
));

test('Scenario #4', expectMessage(
    fn() => v::not(v::graph("\n"))->assert("foo\nbar"),
    '"foo\\nbar" must not contain graphical characters or "\\n"',
));

test('Scenario #5', expectFullMessage(
    fn() => v::graph()->assert("foo\nbar"),
    '- "foo\\nbar" must contain only graphical characters',
));

test('Scenario #6', expectFullMessage(
    fn() => v::graph('foo')->assert("foo\nbar"),
    '- "foo\\nbar" must contain only graphical characters and "foo"',
));

test('Scenario #7', expectFullMessage(
    fn() => v::not(v::graph())->assert('foobar'),
    '- "foobar" must not contain graphical characters',
));

test('Scenario #8', expectFullMessage(
    fn() => v::not(v::graph("\n"))->assert("foo\nbar"),
    '- "foo\\nbar" must not contain graphical characters or "\\n"',
));
