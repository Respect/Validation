<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchFullMessage(
    fn() => v::named('the given data', v::init()
        ->property(
            'mysql',
            v::init()
                ->property('host', v::stringType())
                ->property('user', v::stringType())
                ->property('password', v::stringType())
                ->property('schema', v::stringType()),
        )
        ->property(
            'postgresql',
            v::init()
                ->property('host', v::stringType())
                ->property('user', v::stringType())
                ->property('password', v::stringType())
                ->property('schema', v::stringType()),
        ))
        ->assert(json_decode((string) json_encode([
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
        ]))),
    fn(string $fullMessage) => expect($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - the given data must pass all the rules
          - `.mysql` must pass the rules
            - `.mysql.host` must be a string
          - `.postgresql` must pass the rules
            - `.postgresql.user` must be a string
        FULL_MESSAGE),
));
