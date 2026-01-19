<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('default template', catchAll(
    fn() => v::falsy()->assert('non-falsy'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"non-falsy" must be falsy')
        ->and($fullMessage)->toBe('- "non-falsy" must be falsy')
        ->and($messages)->toBe(['falsy' => '"non-falsy" must be falsy']),
));

test('inverted template', catchAll(
    fn() => v::not(v::falsy())->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`null` must not be falsy')
        ->and($fullMessage)->toBe('- `null` must not be falsy')
        ->and($messages)->toBe(['notFalsy' => '`null` must not be falsy']),
));
