<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

test('default template', catchAll(
    fn() => v::trimmed()->assert(' word'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('" word" must not contain leading or trailing whitespace')
        ->and($fullMessage)->toBe('- " word" must not contain leading or trailing whitespace')
        ->and($messages)->toBe(['trimmed' => '" word" must not contain leading or trailing whitespace']),
));

test('inverted template', catchAll(
    fn() => v::not(v::trimmed())->assert('word'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"word" must contain leading or trailing whitespace')
        ->and($fullMessage)->toBe('- "word" must contain leading or trailing whitespace')
        ->and($messages)->toBe(['notTrimmed' => '"word" must contain leading or trailing whitespace']),
));

test('custom alternatives', catchMessage(
    fn() => v::trimmed('foo', 'bar')->assert('foobaz'),
    fn(string $message) => expect($message)->toBe('"foobaz" must not contain leading or trailing "foo" or "bar"'),
));

test('custom alternatives inverted template', catchMessage(
    fn() => v::not(v::trimmed('foo', 'bar'))->assert('bazqux'),
    fn(string $message) => expect($message)->toBe('"bazqux" must contain leading or trailing "foo" or "bar"'),
));
