<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/179', catchAll(
    function (): void {
        $config = [
            'host' => 1,
            'password' => 'my_password',
            'schema' => 'my_schema',
        ];

        $validator = v::arrayType();
        $validator->setName('Settings');
        $validator->key('host', v::stringType());
        $validator->key('user', v::stringType());
        $validator->key('password', v::stringType());
        $validator->key('schema', v::stringType());
        $validator->assert($config);
    },
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.host` must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - Settings must pass the rules
              - `.host` must be a string
              - `.user` must be present
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Settings must pass the rules',
            'host' => '`.host` must be a string',
            'user' => '`.user` must be present',
        ])
));
