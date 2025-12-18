<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::symbolicLink()->assert('tests/fixtures/fake-filename'),
    fn(string $message) => expect($message)->toBe('"tests/fixtures/fake-filename" must be a symbolic link')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::symbolicLink())->assert('tests/fixtures/symbolic-link'),
    fn(string $message) => expect($message)->toBe('"tests/fixtures/symbolic-link" must not be a symbolic link')
));

test('Scenario #3', catchFullMessage(
    fn() => v::symbolicLink()->assert('tests/fixtures/fake-filename'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "tests/fixtures/fake-filename" must be a symbolic link')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::symbolicLink())->assert('tests/fixtures/symbolic-link'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "tests/fixtures/symbolic-link" must not be a symbolic link')
));
