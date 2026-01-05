<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::slug()->assert('my-Slug'),
    fn(string $message) => expect($message)->toBe('"my-Slug" must be a valid slug'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::slug())->assert('my-slug'),
    fn(string $message) => expect($message)->toBe('"my-slug" must not be a valid slug'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::slug()->assert('my-Slug'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "my-Slug" must be a valid slug'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::slug())->assert('my-slug'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "my-slug" must not be a valid slug'),
));
