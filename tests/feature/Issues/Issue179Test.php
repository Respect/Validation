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

        $validator = v::named(
            v::arrayType()
                ->key('host', v::stringType())
                ->key('user', v::stringType())
                ->key('password', v::stringType())
                ->key('schema', v::stringType()),
            'Settings',
        );
        $validator->assert($config);
    },
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.host` (<- Settings) must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - Settings must pass the rules
              - `.host` must be a string
              - `.user` must be present
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Settings must pass the rules',
            'host' => '`.host` must be a string',
            'user' => '`.user` must be present',
        ]),
));
