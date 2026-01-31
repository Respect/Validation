<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

use Respect\StringFormatter\FormatterBuilder as f;

test('input is not a string', catchAll(
    fn() => v::formatted(f::mask('1-'), v::alnum())->assert(new stdClass()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`stdClass {}` must be a string')
        ->and($fullMessage)->toBe('- `stdClass {}` must be a string')
        ->and($messages)->toBe(['alnum' => '`stdClass {}` must be a string']),
));

test('failed validator with masked input', catchAll(
    fn() => v::formatted(f::mask('1-4'), v::email())->assert('not an email'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"****an email" must be an email address')
        ->and($fullMessage)->toBe('- "****an email" must be an email address')
        ->and($messages)->toBe(['email' => '"****an email" must be an email address']),
));

test('failed validator with pattern formatted input', catchAll(
    fn() => v::formatted(f::pattern('#### #### #### ####'), v::creditCard())->assert('1234123412341234'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"1234 1234 1234 1234" must be a credit card number')
        ->and($fullMessage)->toBe('- "1234 1234 1234 1234" must be a credit card number')
        ->and($messages)->toBe(['creditCard' => '"1234 1234 1234 1234" must be a credit card number']),
));
