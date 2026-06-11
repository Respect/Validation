<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Given condition matches, then fails', catchAll(
    fn() => v::given(v::intVal(), v::positive())->assert(-1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-1 must be a positive number')
        ->and($fullMessage)->toBe('- -1 must be a positive number')
        ->and($messages)->toBe(['positive' => '-1 must be a positive number']),
));

test('Given condition matches, then fails, using single template', catchAll(
    fn() => v::given(v::intVal(), v::positive())->assert(-1, 'That did not go as planned'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('That did not go as planned')
        ->and($fullMessage)->toBe('- That did not go as planned')
        ->and($messages)->toBe(['positive' => 'That did not go as planned']),
));

test('Given condition matches, then fails, using array template', catchAll(
    fn() => v::given(v::intVal(), v::positive())->assert(-1, ['positive' => 'Not a positive number']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Not a positive number')
        ->and($fullMessage)->toBe('- Not a positive number')
        ->and($messages)->toBe(['positive' => 'Not a positive number']),
));
