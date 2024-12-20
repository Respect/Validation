<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1376', expectAll(
    fn() => v::create()
        ->property('title', v::lengthBetween(2, 3)->stringType())
        ->property('description', v::stringType())
        ->property('author', v::intType()->lengthBetween(1, 2))
        ->property('user', v::intVal()->lengthBetween(1, 2))
        ->assert((object) ['author' => 'foo']),
    'title must be present',
    <<<'FULL_MESSAGE'
    - All the required rules must pass for `stdClass { +$author="foo" }`
      - title must be present
      - description must be present
      - All the required rules must pass for author
        - author must be an integer
        - The length of author must be between 1 and 2
      - user must be present
    FULL_MESSAGE,
    [
        '__root__' => 'All the required rules must pass for `stdClass { +$author="foo" }`',
        'title' => 'title must be present',
        'description' => 'description must be present',
        'author' => [
            '__root__' => 'All the required rules must pass for author',
            'intType' => 'author must be an integer',
            'lengthBetween' => 'The length of author must be between 1 and 2',
        ],
        'user' => 'user must be present',
    ]
));
