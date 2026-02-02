<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::languageCode()->assert(null),
    fn(string $message) => expect($message)->toBe('`null` must be a language code'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::languageCode())->assert('pt'),
    fn(string $message) => expect($message)->toBe('"pt" must not be a language code'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::languageCode()->assert('por'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "por" must be a language code'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::languageCode())->assert('en'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "en" must not be a language code'),
));
