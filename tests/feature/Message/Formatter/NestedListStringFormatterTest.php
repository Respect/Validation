<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

// Orphan Collapsing

test('Deep single-child chain collapses entirely to the leaf error', catchAll(
    fn() => v::init()->key('email', v::email())->assert(['email' => 'not-an-email']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.email` must be an email address')
        ->and($fullMessage)->toBe('- `.email` must be an email address')
        ->and($messages)->toBe(['email' => '`.email` must be an email address']),
));

test('Three levels of nested keys collapse to the leaf error', catchAll(
    fn() => v::init()
        ->key('server', v::init()
            ->key('database', v::init()
                ->key('host', v::stringType())))
        ->assert(['server' => ['database' => ['host' => 123]]]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.server.database.host` must be a string')
        ->and($fullMessage)->toBe('- `.server.database.host` must be a string')
        ->and($messages)->toBe(['host' => '`.server.database.host` must be a string']),
));

test('Single-child siblings all collapse when none has multiple children', catchAll(
    fn() => v::init()
        ->key('email', v::email())
        ->key('age', v::intType())
        ->assert(['email' => 'bad', 'age' => 'old']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.email` must be an email address')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `["email": "bad", "age": "old"]` must pass all the rules
          - `.email` must be an email address
          - `.age` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`["email": "bad", "age": "old"]` must pass all the rules',
            'email' => '`.email` must be an email address',
            'age' => '`.age` must be an integer',
        ]),
));

test('Sibling with multiple failures forces single-child sibling to become visible', catchAll(
    fn() => v::init()
        ->key('username', v::alnum()->lengthBetween(3, 20))
        ->key('email', v::email())
        ->assert(['username' => '!!', 'email' => 'invalid']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.username` must consist only of letters (a-z) and digits (0-9)')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `["username": "!!", "email": "invalid"]` must pass all the rules
          - `.username` must pass all the rules
            - `.username` must consist only of letters (a-z) and digits (0-9)
            - The length of `.username` must be between 3 and 20
          - `.email` must be an email address
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`["username": "!!", "email": "invalid"]` must pass all the rules',
            'username' => [
                '__root__' => '`.username` must pass all the rules',
                0 => '`.username` must consist only of letters (a-z) and digits (0-9)',
                1 => 'The length of `.username` must be between 3 and 20',
            ],
            'email' => '`.email` must be an email address',
        ]),
));

test('Custom template on wrapper prevents collapsing even with single child', catchAll(
    fn() => v::templated('Data validation failed', v::init()
        ->key('email', v::email())
        ->key('age', v::intType()))
        ->assert(['email' => 'bad', 'age' => 'old']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Data validation failed')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Data validation failed
          - `.email` must be an email address
          - `.age` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Data validation failed',
            'email' => '`.email` must be an email address',
            'age' => '`.age` must be an integer',
        ]),
));

// Deep Nesting

test('Four levels of single-child nesting collapse entirely', catchAll(
    fn() => v::init()
        ->key('app', v::init()
            ->key('server', v::init()
                ->key('database', v::init()
                    ->key('host', v::stringType()))))
        ->assert(['app' => ['server' => ['database' => ['host' => false]]]]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.app.server.database.host` must be a string')
        ->and($fullMessage)->toBe('- `.app.server.database.host` must be a string')
        ->and($messages)->toBe(['host' => '`.app.server.database.host` must be a string']),
));

test('Mixed depth siblings render at different levels in full message', catchAll(
    fn() => v::init()
        ->key('name', v::alpha())
        ->key('server', v::init()
            ->key('database', v::init()
                ->key('host', v::stringType())))
        ->assert(['name' => '123', 'server' => ['database' => ['host' => false]]]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.name` must consist only of letters (a-z)')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `["name": "123", "server": ["database": ["host": false]]]` must pass all the rules
          - `.name` must consist only of letters (a-z)
          - `.server.database.host` must be a string
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`["name": "123", "server": ["database": ["host": false]]]` must pass all the rules',
            'name' => '`.name` must consist only of letters (a-z)',
            'host' => '`.server.database.host` must be a string',
        ]),
));

// Name Deduplication

test('Named wrapper shows name once, children use raw input instead', catchAll(
    fn() => v::named('User Age', v::intType()->positive())->assert('old'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('User Age must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - User Age must pass all the rules
          - "old" must be an integer
          - "old" must be a positive number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'User Age must pass all the rules',
            'intType' => '"old" must be an integer',
            'positive' => '"old" must be a positive number',
        ]),
));

test('Differently named inner validator preserves its own name', catchAll(
    fn() => v::named('Registration', v::init()->key('email', v::named('Email Address', v::email())))->assert(['email' => 'bad']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Email Address must be an email address')
        ->and($fullMessage)->toBe('- Email Address must be an email address')
        ->and($messages)->toBe(['email' => 'Email Address must be an email address']),
));
