<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::readable()->assert('tests/fixtures/invalid-image.jpg'),
    fn(string $message) => expect($message)->toBe('"tests/fixtures/invalid-image.jpg" must be readable'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::readable())->assert('tests/fixtures/valid-image.png'),
    fn(string $message) => expect($message)->toBe('"tests/fixtures/valid-image.png" must not be readable'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::readable()->assert(new stdClass()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `stdClass {}` must be readable'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::readable())->assert('tests/fixtures/valid-image.png'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "tests/fixtures/valid-image.png" must not be readable'),
));
