<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessages(
    function (): void {
        v::create()
            ->key(
                'mysql',
                v::create()
                    ->key('host', v::stringType())
                    ->key('user', v::stringType())
                    ->key('password', v::stringType())
                    ->key('schema', v::stringType()),
            )
            ->key(
                'postgresql',
                v::create()
                    ->key('host', v::stringType())
                    ->key('user', v::stringType())
                    ->key('password', v::stringType())
                    ->key('schema', v::stringType()),
            )
            ->assert(
                [
                    'mysql' => [
                        'host' => 42,
                        'schema' => 42,
                    ],
                    'postgresql' => [
                        'user' => 42,
                        'password' => 42,
                    ],
                ],
                [
                    'mysql' => [
                        'user' => 'Value should be a MySQL username',
                        'host' => '`{{name}}` should be a MySQL host',
                    ],
                    'postgresql' => [
                        'schema' => 'You must provide a valid PostgreSQL schema',
                    ],
                ],
            );
    },
    [
        '__root__' => '`["mysql": ["host": 42, "schema": 42], "postgresql": ["user": 42, "password": 42]]` must pass all the rules',
        'mysql' => [
            '__root__' => '`.mysql` must pass all the rules',
            'host' => '``.host`` should be a MySQL host',
            'user' => 'Value should be a MySQL username',
            'password' => '`.password` must be present',
            'schema' => '`.schema` must be a string',
        ],
        'postgresql' => [
            '__root__' => '`.postgresql` must pass all the rules',
            'host' => '`.host` must be present',
            'user' => '`.user` must be a string',
            'password' => '`.password` must be a string',
            'schema' => 'You must provide a valid PostgreSQL schema',
        ],
    ],
));
