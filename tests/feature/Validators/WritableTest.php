<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::writable()->assert('/path/of/a/valid/writable/file.txt'),
    fn(string $message) => expect($message)->toBe('"/path/of/a/valid/writable/file.txt" must be an accessible existing writable filesystem entry'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::writable())->assert('tests/fixtures/valid-image.png'),
    fn(string $message) => expect($message)->toBe('"tests/fixtures/valid-image.png" must not be an accessible existing writable filesystem entry'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::writable()->assert([]),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `[]` must be an accessible existing writable filesystem entry'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::writable())->assert('tests/fixtures/invalid-image.png'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "tests/fixtures/invalid-image.png" must not be an accessible existing writable filesystem entry'),
));
