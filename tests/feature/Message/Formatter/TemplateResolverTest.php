<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

test('Path-based templates override default messages for each key', catchAll(
    fn() => v::init()
        ->key('email', v::email())
        ->key('age', v::intType())
        ->assert(
            ['email' => 'bad', 'age' => 'young'],
            ['email' => 'Please enter a valid email', 'age' => 'Age must be a number'],
        ),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Please enter a valid email')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `["email": "bad", "age": "young"]` must pass all the rules
          - Please enter a valid email
          - Age must be a number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`["email": "bad", "age": "young"]` must pass all the rules',
            'email' => 'Please enter a valid email',
            'age' => 'Age must be a number',
        ]),
));

test('Nested path-based templates resolve through key hierarchy', catchAll(
    fn() => v::init()
        ->key('address', v::init()->key('zip', v::digit()))
        ->assert(
            ['address' => ['zip' => 'invalid']],
            ['address' => ['zip' => 'Please enter a valid ZIP code']],
        ),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Please enter a valid ZIP code')
        ->and($fullMessage)->toBe('- Please enter a valid ZIP code')
        ->and($messages)->toBe(['zip' => 'Please enter a valid ZIP code']),
));

test('__root__ template overrides only the parent composite message', catchAll(
    fn() => v::init()
        ->key('email', v::email())
        ->key('age', v::intType())
        ->assert(
            ['email' => 'bad', 'age' => 'old'],
            ['__root__' => 'Registration data is invalid'],
        ),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.email` must be an email address')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Registration data is invalid
          - `.email` must be an email address
          - `.age` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Registration data is invalid',
            'email' => '`.email` must be an email address',
            'age' => '`.age` must be an integer',
        ]),
));

test('Nested __root__ targets only the inner composite, not its children', catchAll(
    fn() => v::init()
        ->key('address', v::init()->key('zip', v::digit())->key('city', v::alpha()))
        ->assert(
            ['address' => ['zip' => 'bad', 'city' => '123']],
            ['address' => ['__root__' => 'Address section has errors']],
        ),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.address.zip` must consist only of digits (0-9)')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Address section has errors
          - `.address.zip` must consist only of digits (0-9)
          - `.address.city` must consist only of letters (a-z)
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Address section has errors',
            'zip' => '`.address.zip` must consist only of digits (0-9)',
            'city' => '`.address.city` must consist only of letters (a-z)',
        ]),
));

test('__root__ does not cascade to non-path children in flat AllOf', catchAll(
    fn() => v::allOf(v::stringType(), v::arrayType())->assert(5, ['__root__' => 'Input is invalid']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('5 must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Input is invalid
          - 5 must be a string
          - 5 must be an array
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Input is invalid',
            'stringType' => '5 must be a string',
            'arrayType' => '5 must be an array',
        ]),
));

test('__root__ with partial child templates leaves unmatched children at defaults', catchAll(
    fn() => v::init()
        ->key('email', v::email())
        ->key('name', v::stringType())
        ->key('age', v::intType())
        ->assert(
            ['email' => 'bad', 'name' => 123, 'age' => 'old'],
            ['__root__' => 'Form validation failed', 'email' => 'Please provide a valid email'],
        ),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Please provide a valid email')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Form validation failed
          - Please provide a valid email
          - `.name` must be a string
          - `.age` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Form validation failed',
            'email' => 'Please provide a valid email',
            'name' => '`.name` must be a string',
            'age' => '`.age` must be an integer',
        ]),
));

test('Template with {{subject}} placeholder renders the path', catchAll(
    fn() => v::init()
        ->key('email', v::email())
        ->assert(
            ['email' => 'bad'],
            ['email' => '{{subject}} is not a valid email address'],
        ),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.email` is not a valid email address')
        ->and($fullMessage)->toBe('- `.email` is not a valid email address')
        ->and($messages)->toBe(['email' => '`.email` is not a valid email address']),
));

test('Three-level deep template resolves to the leaf path', catchAll(
    fn() => v::init()
        ->key('server', v::init()
            ->key('database', v::init()
                ->key('host', v::stringType())))
        ->assert(
            ['server' => ['database' => ['host' => 123]]],
            ['server' => ['database' => ['host' => 'Must be a hostname string']]],
        ),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Must be a hostname string')
        ->and($fullMessage)->toBe('- Must be a hostname string')
        ->and($messages)->toBe(['host' => 'Must be a hostname string']),
));

test('String template at intermediate path overrides that composite only', catchAll(
    fn() => v::init()
        ->key('server', v::init()
            ->key('database', v::init()
                ->key('host', v::stringType())
                ->key('port', v::intType())))
        ->assert(
            ['server' => ['database' => ['host' => 123, 'port' => 'wrong']]],
            ['server' => ['database' => 'Database configuration is invalid']],
        ),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.server.database.host` must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Database configuration is invalid
          - `.server.database.host` must be a string
          - `.server.database.port` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Database configuration is invalid',
            'host' => '`.server.database.host` must be a string',
            'port' => '`.server.database.port` must be an integer',
        ]),
));

test('Partial deep templates override matched children, siblings get defaults', catchAll(
    fn() => v::init()
        ->key('server', v::init()
            ->key('database', v::init()
                ->key('host', v::stringType())
                ->key('port', v::intType())))
        ->assert(
            ['server' => ['database' => ['host' => 123, 'port' => 'wrong']]],
            ['server' => ['database' => ['host' => 'Host must be a string']]],
        ),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Host must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `.server.database` must pass all the rules
          - Host must be a string
          - `.server.database.port` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`.server.database` must pass all the rules',
            'host' => 'Host must be a string',
            'port' => '`.server.database.port` must be an integer',
        ]),
));

test('Deep templates for all siblings at the same level', catchAll(
    fn() => v::init()
        ->key('server', v::init()
            ->key('database', v::init()
                ->key('host', v::stringType())
                ->key('port', v::intType())))
        ->assert(
            ['server' => ['database' => ['host' => 123, 'port' => 'bad']]],
            ['server' => ['database' => ['host' => 'Host must be a string', 'port' => 'Port must be an integer']]],
        ),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Host must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - `.server.database` must pass all the rules
          - Host must be a string
          - Port must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`.server.database` must pass all the rules',
            'host' => 'Host must be a string',
            'port' => 'Port must be an integer',
        ]),
));

test('__root__ at multiple nesting levels targets each composite independently', catchAll(
    fn() => v::init()
        ->key('email', v::email())
        ->key('address', v::init()->key('zip', v::digit())->key('city', v::alpha()))
        ->assert(
            ['email' => 'bad', 'address' => ['zip' => '!!', 'city' => '123']],
            ['__root__' => 'Validation failed', 'address' => ['__root__' => 'Address is invalid']],
        ),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.email` must be an email address')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Validation failed
          - `.email` must be an email address
          - Address is invalid
            - `.address.zip` must consist only of digits (0-9)
            - `.address.city` must consist only of letters (a-z)
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Validation failed',
            'email' => '`.email` must be an email address',
            'address' => [
                '__root__' => 'Address is invalid',
                'zip' => '`.address.zip` must consist only of digits (0-9)',
                'city' => '`.address.city` must consist only of letters (a-z)',
            ],
        ]),
));

test('__root__ at deepest nested level scopes to that composite only', catchAll(
    fn() => v::init()
        ->key('server', v::init()
            ->key('database', v::init()
                ->key('host', v::stringType())
                ->key('port', v::intType())))
        ->assert(
            ['server' => ['database' => ['host' => 123, 'port' => 'bad']]],
            ['server' => ['database' => ['__root__' => 'Database config is invalid']]],
        ),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.server.database.host` must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Database config is invalid
          - `.server.database.host` must be a string
          - `.server.database.port` must be an integer
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Database config is invalid',
            'host' => '`.server.database.host` must be a string',
            'port' => '`.server.database.port` must be an integer',
        ]),
));

test('{{subject}} placeholder resolves at three-level deep path', catchAll(
    fn() => v::init()
        ->key('server', v::init()
            ->key('database', v::init()
                ->key('host', v::stringType())))
        ->assert(
            ['server' => ['database' => ['host' => 123]]],
            ['server' => ['database' => ['host' => '{{subject}} is not a valid hostname']]],
        ),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.server.database.host` is not a valid hostname')
        ->and($fullMessage)->toBe('- `.server.database.host` is not a valid hostname')
        ->and($messages)->toBe(['host' => '`.server.database.host` is not a valid hostname']),
));

test('Flat template key matches by leaf path value regardless of nesting depth', catchAll(
    fn() => v::init()
        ->key('server', v::init()
            ->key('database', v::init()
                ->key('host', v::stringType())))
        ->assert(
            ['server' => ['database' => ['host' => 123]]],
            ['host' => 'Hostname must be a string'],
        ),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Hostname must be a string')
        ->and($fullMessage)->toBe('- Hostname must be a string')
        ->and($messages)->toBe(['host' => 'Hostname must be a string']),
));
