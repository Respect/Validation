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
    'groups must be an integer value',
    <<<'FULL_MESSAGE'
    - Each item in `[16: ["groups": [1, "A", 3, 4, 5], "permissions": ["perm1": true, "perm2": false, "perm3": "boom!"]], 18: false, ... ]` must be valid
      - These rules must pass for `["groups": [1, "A", 3, 4, 5], "permissions": ["perm1": true, "perm2": false, "perm3": "boom!"]]`
        - Each item in groups must be valid
          - groups must be an integer value
        - Each item in permissions must be valid
          - permissions must be a boolean value
      - All the required rules must pass for `false`
        - `false` must be an array value
        - groups must be present
        - permissions must be present
      - These rules must pass for `["permissions": false]`
        - groups must be present
        - permissions must be iterable
    FULL_MESSAGE,
    [
        '__root' => 'Each item in `[16: ["groups": [1, "A", 3, 4, 5], "permissions": ["perm1": true, "perm2": false, "perm3": "boom!"]], 18: false, ... ]` must be valid',
        16 => [
            '__root' => 'These rules must pass for `["groups": [1, "A", 3, 4, 5], "permissions": ["perm1": true, "perm2": false, "perm3": "boom!"]]`',
            'groups' => [
                '__root' => 'Each item in groups must be valid',
                1 => 'groups must be an integer value',
            ],
            'permissions' => [
                '__root' => 'Each item in permissions must be valid',
                'perm3' => 'permissions must be a boolean value',
            ],
        ],
        18 => [
            '__root' => 'All the required rules must pass for `false`',
            'arrayVal' => '`false` must be an array value',
            'groups' => 'groups must be present',
            'permissions' => 'permissions must be present',
        ],
        24 => [
            '__root' => 'These rules must pass for `["permissions": false]`',
            'groups' => 'groups must be present',
            'permissions' => 'permissions must be iterable',
        ],
    ]
));
