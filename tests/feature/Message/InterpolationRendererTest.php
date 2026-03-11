<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

test('givenTemplate suppresses adjacent result concatenation', catchAll(
    fn() => v::templated('Password is too short', v::lengthBetween(8, 64))->assert('hi'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Password is too short')
        ->and($fullMessage)->toBe('- Password is too short')
        ->and($messages)->toBe(['lengthBetween' => 'Password is too short']),
));

test('Adjacent result renders path-aware subject in compound message', catchAll(
    fn() => v::init()->key('password', v::lengthBetween(8, 64))->assert(['password' => 'hi']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The length of `.password` must be between 8 and 64')
        ->and($fullMessage)->toBe('- The length of `.password` must be between 8 and 64')
        ->and($messages)->toBe(['password' => 'The length of `.password` must be between 8 and 64']),
));
