<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/discussions/1427', expectAll(
    fn () => v::each(
        v::arrayVal()
            ->key('groups', v::each(v::intVal()))
            ->key('permissions', v::each(v::boolVal()))
    )
        ->assert([
            16 => [
                'groups' => [1, 'A', 3, 4, 5],
                'permissions' => [
                    'perm1' => true,
                    'perm2' => false,
                    'perm3' => 'boom!',
                ],
            ],
            18 => false,
            24 => ['permissions' => false],
        ]),
    '`.16.groups.1` must be an integer value',
    <<<'FULL_MESSAGE'
    - Each item in `[16: ["groups": [1, "A", 3, 4, 5], "permissions": ["perm1": true, "perm2": false, "perm3": "boom!"]], 18: false, ... ]` must be valid
      - `.16` must pass the rules
        - Each item in `.groups` must be valid
          - `.1` must be an integer value
        - Each item in `.permissions` must be valid
          - `.perm3` must be a boolean value
      - `.18` must pass all the rules
        - `.18` must be an array value
        - `.groups` must be present
        - `.permissions` must be present
      - `.24` must pass the rules
        - `.groups` must be present
        - `.permissions` must be iterable
    FULL_MESSAGE,
    [
        'messages' => ['each' => 'Each item in `[16: ["groups": [1, "A", 3, 4, 5], "permissions": ["perm1": true, "perm2": false, "perm3": "boom!"]], 18: false, ... ]` must be valid'],
        'children' => [
            16 => [
                'messages' => ['allOf' => '`["groups": [1, "A", 3, 4, 5], "permissions": ["perm1": true, "perm2": false, "perm3": "boom!"]]` must pass the rules'],
                'children' => [
                    'groups' => [
                        'messages' => ['each' => 'Each item in `[1, "A", 3, 4, 5]` must be valid'],
                        'children' => [
                            1 => [
                                'messages' => ['intVal' => '"A" must be an integer value'],
                            ],
                        ],
                    ],
                    'permissions' => [
                        'messages' => ['each' => 'Each item in `["perm1": true, "perm2": false, "perm3": "boom!"]` must be valid'],
                        'children' => [
                            'perm3' => [
                                'messages' => ['boolVal' => '"boom!" must be a boolean value'],
                            ],
                        ],
                    ],
                ],
            ],
            18 => [
                'messages' => ['allOf' => '`false` must pass all the rules'],
                'details' => ['arrayVal' => '`false` must be an array value'],
                'children' => [
                    'groups' => [
                        'messages' => ['keyExists' => '`false` must be present'],
                    ],
                    'permissions' => [
                        'messages' => ['keyExists' => '`false` must be present'],
                    ],
                ],
            ],
            24 => [
                'messages' => ['allOf' => '`["permissions": false]` must pass the rules'],
                'children' => [
                    'groups' => [
                        'messages' => ['keyExists' => '`["permissions": false]` must be present'],
                    ],
                    'permissions' => [
                        'messages' => ['each' => '`false` must be iterable'],
                    ],
                ],
            ],
        ],
    ]
));
