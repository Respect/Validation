<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('default template', catchAll(
    fn() => v::spaced()->assert('word'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"word" must contain at least one whitespace')
        ->and($fullMessage)->toBe('- "word" must contain at least one whitespace')
        ->and($messages)->toBe(['spaced' => '"word" must contain at least one whitespace']),
));

test('inverted template', catchAll(
    fn() => v::not(v::spaced())->assert('two words'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"two words" must not contain whitespace')
        ->and($fullMessage)->toBe('- "two words" must not contain whitespace')
        ->and($messages)->toBe(['notSpaced' => '"two words" must not contain whitespace']),
));
