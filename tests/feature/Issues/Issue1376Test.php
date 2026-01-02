<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1376', catchAll(
    fn() => v::init()
        ->property('title', v::lengthBetween(2, 3)->stringType())
        ->property('description', v::stringType())
        ->property('author', v::intType()->lengthBetween(1, 2))
        ->property('user', v::intVal()->lengthBetween(1, 2))
        ->assert((object) ['author' => 'foo']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.title` must be present')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - `stdClass { +$author="foo" }` must pass all the rules
              - `.title` must be present
              - `.description` must be present
              - `.author` must pass all the rules
                - `.author` must be an integer
                - The length of `.author` must be between 1 and 2
              - `.user` must be present
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '`stdClass { +$author="foo" }` must pass all the rules',
            'title' => '`.title` must be present',
            'description' => '`.description` must be present',
            'author' => 'The length of `.author` must be between 1 and 2',
            'user' => '`.user` must be present',
        ]),
));
