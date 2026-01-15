<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('input is not a string', catchAll(
    fn() => v::masked('1-@', v::email())->assert(new stdClass()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`stdClass {}` must be a string value')
        ->and($fullMessage)->toBe('- `stdClass {}` must be a string value')
        ->and($messages)->toBe(['email' => '`stdClass {}` must be a string value']),
));

test('failed validator', catchAll(
    fn() => v::masked('1-@', v::email())->assert('in valid@email.com'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"********@email.com" must be a valid email address')
        ->and($fullMessage)->toBe('- "********@email.com" must be a valid email address')
        ->and($messages)->toBe(['email' => '"********@email.com" must be a valid email address']),
));
