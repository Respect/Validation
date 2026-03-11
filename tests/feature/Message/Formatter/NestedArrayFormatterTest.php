<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

// String Key Detection

test('String keys from associative array propagate to messages output', catchAll(
    fn() => v::each(v::intType())->assert(['id' => 'John', 'age' => 'thirty']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.id` must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each item in `["id": "John", "age": "thirty"]` must be valid
          - `.id` must be an integer
          - `.age` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each item in `["id": "John", "age": "thirty"]` must be valid',
            'id' => '`.id` must be an integer',
            'age' => '`.age` must be an integer',
        ]),
));

test('Sparse failures renumber to sequential keys in messages output', catchAll(
    fn() => v::each(v::intType())->assert([1, 'two', 3, 'four']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.1` must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each item in `[1, "two", 3, "four"]` must be valid
          - `.1` must be an integer
          - `.3` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each item in `[1, "two", 3, "four"]` must be valid',
            0 => '`.1` must be an integer',
            1 => '`.3` must be an integer',
        ]),
));

// __root__ Key and Nesting

test('__root__ key omitted when only one child message exists', catchAll(
    fn() => v::init()->key('email', v::email())->assert(['email' => 'bad']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.email` must be an email address')
        ->and($fullMessage)->toBe('- `.email` must be an email address')
        ->and($messages)->toBe(['email' => '`.email` must be an email address']),
));

test('__root__ placed at each nesting level with multiple children', catchAll(
    fn() => v::init()
        ->key('database', v::init()->key('host', v::stringType())->key('port', v::intType()))
        ->assert(['database' => ['host' => 123, 'port' => 'wrong']]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.database.host` must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `.database` must pass all the rules
          - `.database.host` must be a string
          - `.database.port` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`.database` must pass all the rules',
            'host' => '`.database.host` must be a string',
            'port' => '`.database.port` must be an integer',
        ]),
));

test('Cross-nesting flattens single-child paths in messages output', catchAll(
    fn() => v::init()
        ->key('database', v::init()->key('host', v::stringType()))
        ->key('cache', v::init()->key('driver', v::in(['redis', 'memcached'])))
        ->assert(['database' => ['host' => false], 'cache' => ['driver' => 'sqlite']]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.database.host` must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `["database": ["host": false], "cache": ["driver": "sqlite"]]` must pass all the rules
          - `.database.host` must be a string
          - `.cache.driver` must be in `["redis", "memcached"]`
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`["database": ["host": false], "cache": ["driver": "sqlite"]]` must pass all the rules',
            'host' => '`.database.host` must be a string',
            'driver' => '`.cache.driver` must be in `["redis", "memcached"]`',
        ]),
));

test('mergeWithExistingPath creates indexed array for same-path collisions', catchAll(
    fn() => v::init()
        ->key('password', v::stringType()->alnum()->lengthBetween(8, 100))
        ->assert(['password' => '']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.password` must consist only of letters (a-z) and digits (0-9)')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `.password` must pass the rules
          - `.password` must consist only of letters (a-z) and digits (0-9)
          - The length of `.password` must be between 8 and 100
        FULL_MESSAGE)
        ->and($messages)->toBe([
            'password' => [
                0 => '`.password` must consist only of letters (a-z) and digits (0-9)',
                1 => 'The length of `.password` must be between 8 and 100',
            ],
        ]),
));

test('Mixed key presence and value failures produce separate keyed messages', catchAll(
    fn() => v::init()
        ->key('email', v::email())
        ->key('name', v::stringType())
        ->assert(['email' => 'invalid-email']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.email` must be an email address')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `["email": "invalid-email"]` must pass all the rules
          - `.email` must be an email address
          - `.name` must be present
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`["email": "invalid-email"]` must pass all the rules',
            'email' => '`.email` must be an email address',
            'name' => '`.name` must be present',
        ]),
));

// Deep Nesting

test('Four-level nesting produces correct full paths in messages', catchAll(
    fn() => v::init()
        ->key('app', v::init()
            ->key('server', v::init()
                ->key('database', v::init()
                    ->key('host', v::stringType())
                    ->key('port', v::intType()))))
        ->assert(['app' => ['server' => ['database' => ['host' => false, 'port' => 'bad']]]]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.app.server.database.host` must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `.app.server.database` must pass all the rules
          - `.app.server.database.host` must be a string
          - `.app.server.database.port` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`.app.server.database` must pass all the rules',
            'host' => '`.app.server.database.host` must be a string',
            'port' => '`.app.server.database.port` must be an integer',
        ]),
));

test('Shallow and deep siblings produce nested array for deep branch', catchAll(
    fn() => v::init()
        ->key('name', v::alpha())
        ->key('config', v::init()
            ->key('db', v::init()
                ->key('host', v::stringType())
                ->key('port', v::intType())))
        ->assert(['name' => '123', 'config' => ['db' => ['host' => false, 'port' => 'x']]]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.name` must consist only of letters (a-z)')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `["name": "123", "config": ["db": ["host": false, "port": "x"]]]` must pass all the rules
          - `.name` must consist only of letters (a-z)
          - `.config.db` must pass all the rules
            - `.config.db.host` must be a string
            - `.config.db.port` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`["name": "123", "config": ["db": ["host": false, "port": "x"]]]` must pass all the rules',
            'name' => '`.name` must consist only of letters (a-z)',
            'db' => [
                '__root__' => '`.config.db` must pass all the rules',
                'host' => '`.config.db.host` must be a string',
                'port' => '`.config.db.port` must be an integer',
            ],
        ]),
));

// Each with Nested Rules

test('String-keyed items with multi-failure children produce nested message arrays', catchAll(
    fn() => v::each(v::intType()->positive())->assert(['x' => -1, 'y' => 'abc']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.x` must be a positive number')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each item in `["x": -1, "y": "abc"]` must be valid
          - `.x` must pass the rules
            - `.x` must be a positive number
          - `.y` must pass all the rules
            - `.y` must be an integer
            - `.y` must be a positive number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each item in `["x": -1, "y": "abc"]` must be valid',
            'x' => '`.x` must be a positive number',
            'y' => [
                '__root__' => '`.y` must pass all the rules',
                0 => '`.y` must be an integer',
                1 => '`.y` must be a positive number',
            ],
        ]),
));
