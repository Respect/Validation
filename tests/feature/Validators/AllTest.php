<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('default template', catchAll(
    fn() => v::all(v::intType())->assert([1, 2, '3']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Every item in `[1, 2, "3"]` must be an integer')
        ->and($fullMessage)->toBe('- Every item in `[1, 2, "3"]` must be an integer')
        ->and($messages)->toBe(['allIntType' => 'Every item in `[1, 2, "3"]` must be an integer']),
));

test('inverted template', catchAll(
    fn() => v::not(v::all(v::intType()))->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Every item in `[1, 2, 3]` must not be an integer')
        ->and($fullMessage)->toBe('- Every item in `[1, 2, 3]` must not be an integer')
        ->and($messages)->toBe(['notAllIntType' => 'Every item in `[1, 2, 3]` must not be an integer']),
));
