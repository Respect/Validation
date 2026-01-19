<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::not(
        v::not(
            v::not(
                v::not(
                    v::not(
                        v::intVal()->positive(),
                    ),
                ),
            ),
        ),
    )->assert(2),
    fn(string $message) => expect($message)->toBe('2 must not be an integer value'),
));

test('Scenario #2', catchFullMessage(
    fn() => v::not(
        v::not(
            v::not(
                v::not(
                    v::not(
                        v::intVal()->positive(),
                    ),
                ),
            ),
        ),
    )->assert(2),
    fn(string $fullMessage) => expect($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - 2 must pass the rules
          - 2 must not be an integer value
          - 2 must not be a positive number
        FULL_MESSAGE),
));
