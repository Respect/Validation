<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('one rule / one failed', catchAll(
    fn() => v::keySet(v::key('foo', v::intType()))->assert(['foo' => 'string']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must be an integer')
        ->and($fullMessage)->toBe('- `.foo` must be an integer')
        ->and($messages)->toBe(['foo' => '`.foo` must be an integer']),
));

test('one rule / one missing key', catchAll(
    fn() => v::keySet(v::keyExists('foo'))->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must be present')
        ->and($fullMessage)->toBe('- `.foo` must be present')
        ->and($messages)->toBe(['foo' => '`.foo` must be present']),
));

test('one rule / one extra key', catchAll(
    fn() => v::keySet(v::keyExists('foo'))->assert(['foo' => 42, 'bar' => 'string']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.bar` must not be present')
        ->and($fullMessage)->toBe('- `.bar` must not be present')
        ->and($messages)->toBe(['bar' => '`.bar` must not be present']),
));

test('one rule / one extra key / one missing key', catchAll(
    fn() => v::keySet(v::keyExists('foo'))->assert(['bar' => true]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must be present')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `["bar": true]` contains both missing and extra keys
          - `.foo` must be present
          - `.bar` must not be present
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`["bar": true]` contains both missing and extra keys',
            'foo' => '`.foo` must be present',
            'bar' => '`.bar` must not be present',
        ]),
));

test('one rule / two extra keys', catchAll(
    fn() => v::keySet(v::keyExists('foo'))->assert(['foo' => 42, 'bar' => 'string', 'baz' => true]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.bar` must not be present')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `["foo": 42, "bar": "string", "baz": true]` contains extra keys
          - `.bar` must not be present
          - `.baz` must not be present
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`["foo": 42, "bar": "string", "baz": true]` contains extra keys',
            'bar' => '`.bar` must not be present',
            'baz' => '`.baz` must not be present',
        ]),
));

test('one rule / more than ten extra keys', catchAll(
    fn() => v::keySet(v::keyExists('foo'))
            ->assert([
                'foo' => 42,
                'bar' => 'string',
                'baz' => true,
                'qux' => false,
                'quux' => 42,
                'corge' => 'string',
                'grault' => true,
                'garply' => false,
                'waldo' => 42,
                'fred' => 'string',
                'plugh' => true,
                'xyzzy' => false,
                'thud' => 42,
            ]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.bar` must not be present')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `["foo": 42, "bar": "string", "baz": true, "qux": false, "quux": 42, ...]` contains extra keys
          - `.bar` must not be present
          - `.baz` must not be present
          - `.qux` must not be present
          - `.quux` must not be present
          - `.corge` must not be present
          - `.grault` must not be present
          - `.garply` must not be present
          - `.waldo` must not be present
          - `.fred` must not be present
          - `.plugh` must not be present
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`["foo": 42, "bar": "string", "baz": true, "qux": false, "quux": 42, ...]` contains extra keys',
            'bar' => '`.bar` must not be present',
            'baz' => '`.baz` must not be present',
            'qux' => '`.qux` must not be present',
            'quux' => '`.quux` must not be present',
            'corge' => '`.corge` must not be present',
            'grault' => '`.grault` must not be present',
            'garply' => '`.garply` must not be present',
            'waldo' => '`.waldo` must not be present',
            'fred' => '`.fred` must not be present',
            'plugh' => '`.plugh` must not be present',
        ]),
));

test('multiple rules / one failed', catchAll(
    fn() => v::keySet(v::keyExists('foo'), v::keyExists('bar'))->assert(['foo' => 42]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.bar` must be present')
        ->and($fullMessage)->toBe('- `.bar` must be present')
        ->and($messages)->toBe(['bar' => '`.bar` must be present']),
));

test('multiple rules / all failed', catchAll(
    fn() => v::keySet(v::keyExists('foo'), v::keyExists('bar'))->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must be present')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `[]` contains missing keys
          - `.foo` must be present
          - `.bar` must be present
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`[]` contains missing keys',
            'foo' => '`.foo` must be present',
            'bar' => '`.bar` must be present',
        ]),
));

test('multiple rules / one extra key', catchAll(
    fn() => v::keySet(
        v::keyExists('foo'),
        v::keyExists('bar'),
    )->assert(['foo' => 42, 'bar' => 'string', 'baz' => true]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.baz` must not be present')
        ->and($fullMessage)->toBe('- `.baz` must not be present')
        ->and($messages)->toBe(['baz' => '`.baz` must not be present']),
));

test('multiple rules / one extra key / one missing', catchAll(
    fn() => v::keySet(
        v::keyExists('foo'),
        v::keyExists('bar'),
    )->assert(['bar' => 'string', 'baz' => true]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must be present')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `["bar": "string", "baz": true]` contains both missing and extra keys
          - `.foo` must be present
          - `.baz` must not be present
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`["bar": "string", "baz": true]` contains both missing and extra keys',
            'foo' => '`.foo` must be present',
            'baz' => '`.baz` must not be present',
        ]),
));

test('multiple rules / two extra keys', catchAll(
    fn() => v::keySet(
        v::keyExists('foo'),
        v::keyExists('bar'),
        v::keyOptional('qux', v::intType()),
    )->assert(['foo' => 42, 'bar' => 'string', 'baz' => true, 'qux' => false]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.qux` must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `["foo": 42, "bar": "string", "baz": true, "qux": false]` contains extra keys
          - `.qux` must be an integer
          - `.baz` must not be present
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`["foo": 42, "bar": "string", "baz": true, "qux": false]` contains extra keys',
            'qux' => '`.qux` must be an integer',
            'baz' => '`.baz` must not be present',
        ]),
));

test('multiple rules / all failed validation', catchAll(
    fn() => v::keySet(
        v::key('foo', v::intType()),
        v::key('bar', v::intType()),
        v::key('baz', v::intType()),
    )
            ->assert(['foo' => 42, 'bar' => 'string', 'baz' => true]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.bar` must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `["foo": 42, "bar": "string", "baz": true]` validation failed
          - `.bar` must be an integer
          - `.baz` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`["foo": 42, "bar": "string", "baz": true]` validation failed',
            'bar' => '`.bar` must be an integer',
            'baz' => '`.baz` must be an integer',
        ]),
));

test('multiple rules / single missing key / single failed validation', catchAll(
    fn() => v::keySet(
        v::init()
            ->key('foo', v::intType())
            ->key('bar', v::intType())
            ->key('baz', v::intType()),
    )
            ->assert(['foo' => 42, 'bar' => 'string']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.bar` must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `["foo": 42, "bar": "string"]` contains missing keys
          - `.bar` must be an integer
          - `.baz` must be present
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`["foo": 42, "bar": "string"]` contains missing keys',
            'bar' => '`.bar` must be an integer',
            'baz' => '`.baz` must be present',
        ]),
));
