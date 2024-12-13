<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('one rule / one failed', expectAll(
    fn() => v::keySet(v::key('foo', v::intType()))->assert(['foo' => 'string']),
    'foo must be an integer',
    '- foo must be an integer',
    ['foo' => 'foo must be an integer']
));

test('one rule / one missing key', expectAll(
    fn() => v::keySet(v::keyExists('foo'))->assert([]),
    'foo must be present',
    '- foo must be present',
    ['foo' => 'foo must be present']
));

test('one rule / one extra key', expectAll(
    fn() => v::keySet(v::keyExists('foo'))->assert(['foo' => 42, 'bar' => 'string']),
    'bar must not be present',
    '- bar must not be present',
    ['bar' => 'bar must not be present']
));

test('one rule / one extra key / one missing key', expectAll(
    fn() => v::keySet(v::keyExists('foo'))->assert(['bar' => true]),
    'foo must be present',
    <<<'FULL_MESSAGE'
    - `["bar": true]` contains both missing and extra keys
      - foo must be present
      - bar must not be present
    FULL_MESSAGE,
    [
        '__root__' => '`["bar": true]` contains both missing and extra keys',
        'foo' => 'foo must be present',
        'bar' => 'bar must not be present',
    ]
));

test('one rule / two extra keys', expectAll(
    fn() => v::keySet(v::keyExists('foo'))->assert(['foo' => 42, 'bar' => 'string', 'baz' => true]),
    'bar must not be present',
    <<<'FULL_MESSAGE'
    - `["foo": 42, "bar": "string", "baz": true]` contains extra keys
      - bar must not be present
      - baz must not be present
    FULL_MESSAGE,
    [
        '__root__' => '`["foo": 42, "bar": "string", "baz": true]` contains extra keys',
        'bar' => 'bar must not be present',
        'baz' => 'baz must not be present',
    ]
));

test('one rule / more than ten extra keys', expectAll(
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
    'bar must not be present',
    <<<'FULL_MESSAGE'
    - `["foo": 42, "bar": "string", "baz": true, "qux": false, "quux": 42, ...]` contains extra keys
      - bar must not be present
      - baz must not be present
      - qux must not be present
      - quux must not be present
      - corge must not be present
      - grault must not be present
      - garply must not be present
      - waldo must not be present
      - fred must not be present
      - plugh must not be present
    FULL_MESSAGE,
    [
        '__root__' => '`["foo": 42, "bar": "string", "baz": true, "qux": false, "quux": 42, ...]` contains extra keys',
        'bar' => 'bar must not be present',
        'baz' => 'baz must not be present',
        'qux' => 'qux must not be present',
        'quux' => 'quux must not be present',
        'corge' => 'corge must not be present',
        'grault' => 'grault must not be present',
        'garply' => 'garply must not be present',
        'waldo' => 'waldo must not be present',
        'fred' => 'fred must not be present',
        'plugh' => 'plugh must not be present',
    ]
));

test('multiple rules / one failed', expectAll(
    fn() => v::keySet(v::keyExists('foo'), v::keyExists('bar'))->assert(['foo' => 42]),
    'bar must be present',
    '- bar must be present',
    ['bar' => 'bar must be present']
));

test('multiple rules / all failed', expectAll(
    fn() => v::keySet(v::keyExists('foo'), v::keyExists('bar'))->assert([]),
    'foo must be present',
    <<<'FULL_MESSAGE'
    - `[]` contains missing keys
      - foo must be present
      - bar must be present
    FULL_MESSAGE,
    [
        '__root__' => '`[]` contains missing keys',
        'foo' => 'foo must be present',
        'bar' => 'bar must be present',
    ]
));

test('multiple rules / one extra key', expectAll(
    fn() => v::keySet(
        v::keyExists('foo'),
        v::keyExists('bar')
    )->assert(['foo' => 42, 'bar' => 'string', 'baz' => true]),
    'baz must not be present',
    '- baz must not be present',
    ['baz' => 'baz must not be present']
));

test('multiple rules / one extra key / one missing', expectAll(
    fn() => v::keySet(
        v::keyExists('foo'),
        v::keyExists('bar')
    )->assert(['bar' => 'string', 'baz' => true]),
    'foo must be present',
    <<<'FULL_MESSAGE'
    - `["bar": "string", "baz": true]` contains both missing and extra keys
      - foo must be present
      - baz must not be present
    FULL_MESSAGE,
    [
        '__root__' => '`["bar": "string", "baz": true]` contains both missing and extra keys',
        'foo' => 'foo must be present',
        'baz' => 'baz must not be present',
    ]
));

test('multiple rules / two extra keys', expectAll(
    fn() => v::keySet(
        v::keyExists('foo'),
        v::keyExists('bar'),
        v::keyOptional('qux', v::intType())
    )->assert(['foo' => 42, 'bar' => 'string', 'baz' => true, 'qux' => false]),
    'qux must be an integer',
    <<<'FULL_MESSAGE'
    - `["foo": 42, "bar": "string", "baz": true, "qux": false]` contains extra keys
      - qux must be an integer
      - baz must not be present
    FULL_MESSAGE,
    [
        '__root__' => '`["foo": 42, "bar": "string", "baz": true, "qux": false]` contains extra keys',
        'qux' => 'qux must be an integer',
        'baz' => 'baz must not be present',
    ]
));

test('multiple rules / all failed validation', expectAll(
    fn() => v::keySet(
        v::key('foo', v::intType()),
        v::key('bar', v::intType()),
        v::key('baz', v::intType())
    )
        ->assert(['foo' => 42, 'bar' => 'string', 'baz' => true]),
    'bar must be an integer',
    <<<'FULL_MESSAGE'
    - `["foo": 42, "bar": "string", "baz": true]` validation failed
      - bar must be an integer
      - baz must be an integer
    FULL_MESSAGE,
    [
        '__root__' => '`["foo": 42, "bar": "string", "baz": true]` validation failed',
        'bar' => 'bar must be an integer',
        'baz' => 'baz must be an integer',
    ]
));

test('multiple rules / single missing key / single failed validation', expectAll(
    fn() => v::keySet(
        v::create()
            ->key('foo', v::intType())
            ->key('bar', v::intType())
            ->key('baz', v::intType())
    )
        ->assert(['foo' => 42, 'bar' => 'string']),
    'bar must be an integer',
    <<<'FULL_MESSAGE'
    - `["foo": 42, "bar": "string"]` contains missing keys
      - bar must be an integer
      - baz must be present
    FULL_MESSAGE,
    [
        '__root__' => '`["foo": 42, "bar": "string"]` contains missing keys',
        'bar' => 'bar must be an integer',
        'baz' => 'baz must be present',
    ]
));
