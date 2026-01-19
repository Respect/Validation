<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::identical(123)->assert(321),
    fn(string $message) => expect($message)->toBe('321 must be identical to 123'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::identical(321))->assert(321),
    fn(string $message) => expect($message)->toBe('321 must not be identical to 321'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::identical(123)->assert(321),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 321 must be identical to 123'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::identical(321))->assert(321),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 321 must not be identical to 321'),
));
