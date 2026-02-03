<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1033', catchAll(
    fn() => v::each(v::equals(1))->assert(['A', 'B', 'B']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.0` must be equal to 1')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - Each item in `["A", "B", "B"]` must be valid
              - `.0` must be equal to 1
              - `.1` must be equal to 1
              - `.2` must be equal to 1
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each item in `["A", "B", "B"]` must be valid',
            0 => '`.0` must be equal to 1',
            1 => '`.1` must be equal to 1',
            2 => '`.2` must be equal to 1',
        ]),
));
