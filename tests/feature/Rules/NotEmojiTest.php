<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::notEmoji()->assert('🍕'),
    fn(string $message) => expect($message)->toBe('"🍕" must not contain an emoji'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::notEmoji())->assert('AB'),
    fn(string $message) => expect($message)->toBe('"AB" must contain an emoji'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::notEmoji()->assert('🏄'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "🏄" must not contain an emoji'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::notEmoji())->assert('YZ'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "YZ" must contain an emoji'),
));
