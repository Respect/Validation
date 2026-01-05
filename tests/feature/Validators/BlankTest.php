<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('default template', catchAll(
    fn() => v::blank()->assert(1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('1 must be blank')
        ->and($fullMessage)->toBe('- 1 must be blank')
        ->and($messages)->toBe(['blank' => '1 must be blank']),
));

test('inverted template', catchAll(
    fn() => v::not(v::blank())->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`null` must not be blank')
        ->and($fullMessage)->toBe('- `null` must not be blank')
        ->and($messages)->toBe(['notBlank' => '`null` must not be blank']),
));
