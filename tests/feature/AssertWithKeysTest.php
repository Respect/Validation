<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchFullMessage(
    fn() => v::named(v::create()
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
        ), 'the given data')
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
    // This is failing because the paths now have name.
    // the name should not be displayed on the children if the parent is being displayed.
    fn(string $fullMessage) => expect($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - the given data must pass all the rules
              - `.mysql` must pass all the rules
                - `.mysql.host` must be a string
                - `.mysql.user` must be present
                - `.mysql.password` must be present
                - `.mysql.schema` must be a string
              - `.postgresql` must pass all the rules
                - `.postgresql.host` must be present
                - `.postgresql.user` must be a string
                - `.postgresql.password` must be a string
                - `.postgresql.schema` must be present
            FULL_MESSAGE),
));
