<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::languageCode()->assert(null),
    fn(string $message) => expect($message)->toBe('`null` must be a valid language code')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::languageCode())->assert('pt'),
    fn(string $message) => expect($message)->toBe('"pt" must not be a valid language code')
));

test('Scenario #3', catchFullMessage(
    fn() => v::languageCode()->assert('por'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "por" must be a valid language code')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::languageCode())->assert('en'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "en" must not be a valid language code')
));
