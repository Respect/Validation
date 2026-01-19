<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::graph()->assert("foo\nbar"),
    fn(string $message) => expect($message)->toBe('"foo\\nbar" must contain only graphical characters'),
));

test('Scenario #2', catchMessage(
    fn() => v::graph('foo')->assert("foo\nbar"),
    fn(string $message) => expect($message)->toBe('"foo\\nbar" must contain only graphical characters and "foo"'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::graph())->assert('foobar'),
    fn(string $message) => expect($message)->toBe('"foobar" must not contain graphical characters'),
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::graph("\n"))->assert("foo\nbar"),
    fn(string $message) => expect($message)->toBe('"foo\\nbar" must not contain graphical characters or "\\n"'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::graph()->assert("foo\nbar"),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "foo\\nbar" must contain only graphical characters'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::graph('foo')->assert("foo\nbar"),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "foo\\nbar" must contain only graphical characters and "foo"'),
));

test('Scenario #7', catchFullMessage(
    fn() => v::not(v::graph())->assert('foobar'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "foobar" must not contain graphical characters'),
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::graph("\n"))->assert("foo\nbar"),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "foo\\nbar" must not contain graphical characters or "\\n"'),
));
