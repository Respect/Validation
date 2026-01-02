<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/796', catchAll(
    fn() => v::named(v::init()
        ->key(
            'mysql',
            v::init()
                ->key('host', v::stringType())
                ->key('user', v::stringType())
                ->key('password', v::stringType())
                ->key('schema', v::stringType()),
        )
        ->key(
            'postgresql',
            v::init()
                ->key('host', v::stringType())
                ->key('user', v::stringType())
                ->key('password', v::stringType())
                ->key('schema', v::stringType()),
        ), 'the given data')
        ->assert([
            'mysql' => [
                'host' => 42,
                'user' => 'user',
                'password' => 'password',
                'schema' => 'schema',
            ],
            'postgresql' => [
                'host' => 'host',
                'user' => 42,
                'password' => 'password',
                'schema' => 'schema',
            ],
        ]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.mysql.host` (<- the given data) must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - the given data must pass all the rules
              - `.mysql` must pass the rules
                - `.mysql.host` must be a string
              - `.postgresql` must pass the rules
                - `.postgresql.user` must be a string
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'the given data must pass all the rules',
            'mysql' => '`.mysql.host` must be a string',
            'postgresql' => '`.postgresql.user` must be a string',
        ]),
));
