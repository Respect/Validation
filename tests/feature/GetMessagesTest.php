<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessages(
    fn() => v::init()
        ->key('mysql', v::init()
            ->key('host', v::stringType())
            ->key('user', v::stringType())->key('password', v::stringType())
            ->key('schema', v::stringType()))
        ->key('postgresql', v::init()
            ->key('host', v::stringType())
            ->key('user', v::stringType())
            ->key('password', v::stringType())
            ->key('schema', v::stringType()))
        ->assert(['mysql' => ['host' => 42, 'schema' => 42], 'postgresql' => ['user' => 42, 'password' => 42]]),
    fn(array $messages) => expect($messages)->toBe([
        '__root__' => '`["mysql": ["host": 42, "schema": 42], "postgresql": ["user": 42, "password": 42]]` must pass all the rules',
        'mysql' => [
            '__root__' => '`.mysql` must pass all the rules',
            'host' => '`.mysql.host` must be a string',
            'user' => '`.mysql.user` must be present',
            'password' => '`.mysql.password` must be present',
            'schema' => '`.mysql.schema` must be a string',
        ],
        'postgresql' => [
            '__root__' => '`.postgresql` must pass all the rules',
            'host' => '`.postgresql.host` must be present',
            'user' => '`.postgresql.user` must be a string',
            'password' => '`.postgresql.password` must be a string',
            'schema' => '`.postgresql.schema` must be present',
        ],
    ]),
));
