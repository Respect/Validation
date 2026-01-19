<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::regex('/^w+$/')->assert('w poiur'),
    fn(string $message) => expect($message)->toBe('"w poiur" must match the pattern `/^w+$/`'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::regex('/^[a-z]+$/'))->assert('wpoiur'),
    fn(string $message) => expect($message)->toBe('"wpoiur" must not match the pattern `/^[a-z]+$/`'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::regex('/^w+$/')->assert(new stdClass()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `stdClass {}` must match the pattern `/^w+$/`'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::regex('/^[a-z]+$/i'))->assert('wPoiur'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "wPoiur" must not match the pattern `/^[a-z]+$/i`'),
));
