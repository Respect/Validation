<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
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
    '2 must not be an integer value',
));

test('Scenario #2', expectFullMessage(
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
    <<<'FULL_MESSAGE'
    - These rules must not pass for 2
      - 2 must not be an integer value
      - 2 must not be a positive number
    FULL_MESSAGE,
));
