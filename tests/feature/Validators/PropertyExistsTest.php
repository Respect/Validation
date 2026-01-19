<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Default mode', catchAll(
    fn() => v::propertyExists('foo')->assert((object) ['bar' => 'baz']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must be present')
        ->and($fullMessage)->toBe('- `.foo` must be present')
        ->and($messages)->toBe(['foo' => '`.foo` must be present']),
));

test('Inverted mode', catchAll(
    fn() => v::not(v::propertyExists('foo'))->assert((object) ['foo' => 'baz']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must not be present')
        ->and($fullMessage)->toBe('- `.foo` must not be present')
        ->and($messages)->toBe(['foo' => '`.foo` must not be present']),
));

test('Custom name', catchAll(
    fn() => v::named('Custom name', v::propertyExists('foo'))->assert((object) ['bar' => 'baz']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` (<- Custom name) must be present')
        ->and($fullMessage)->toBe('- `.foo` (<- Custom name) must be present')
        ->and($messages)->toBe(['foo' => '`.foo` (<- Custom name) must be present']),
));

test('Custom template', catchAll(
    fn() => v::propertyExists('foo')->assert((object) ['bar' => 'baz'], 'Custom template for {{subject}}'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Custom template for `.foo`')
        ->and($fullMessage)->toBe('- Custom template for `.foo`')
        ->and($messages)->toBe(['foo' => 'Custom template for `.foo`']),
));
