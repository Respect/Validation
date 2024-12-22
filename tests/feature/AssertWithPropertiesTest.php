<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectFullMessage(
    function (): void {
        $array = [
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
        ];
        $object = json_decode((string) json_encode($array));
        v::create()
            ->property(
                'mysql',
                v::create()
                    ->property('host', v::stringType())
                    ->property('user', v::stringType())
                    ->property('password', v::stringType())
                    ->property('schema', v::stringType()),
            )
            ->property(
                'postgresql',
                v::create()
                    ->property('host', v::stringType())
                    ->property('user', v::stringType())
                    ->property('password', v::stringType())
                    ->property('schema', v::stringType()),
            )
            ->setName('the given data')
            ->assert($object);
    },
    <<<'FULL_MESSAGE'
    - All the required rules must pass for the given data
      - These rules must pass for mysql
        - host must be a string
      - These rules must pass for postgresql
        - user must be a string
    FULL_MESSAGE,
));
