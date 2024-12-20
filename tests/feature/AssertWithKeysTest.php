<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectFullMessage(
    fn() => v::create()
        ->key(
            'mysql',
            v::create()
                ->key('host', v::stringType())
                ->key('user', v::stringType())
                ->key('password', v::stringType())
                ->key('schema', v::stringType())
        )
        ->key(
            'postgresql',
            v::create()
                ->key('host', v::stringType())
                ->key('user', v::stringType())
                ->key('password', v::stringType())
                ->key('schema', v::stringType())
        )
        ->setName('the given data')
        ->assert([
            'mysql' => [
                'host' => 42,
                'schema' => 42,
            ],
            'postgresql' => [
                'user' => 42,
                'password' => 42,
            ],
        ]),
    <<<'FULL_MESSAGE'
    - All the required rules must pass for the given data
      - All the required rules must pass for mysql
        - host must be a string
        - user must be present
        - password must be present
        - schema must be a string
      - All the required rules must pass for postgresql
        - host must be present
        - user must be a string
        - password must be a string
        - schema must be present
    FULL_MESSAGE,
));
