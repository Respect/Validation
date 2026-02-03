<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/805', catchAll(
    fn() => v::key('email', v::templated('WRONG EMAIL!!!!!!', v::email()))->assert(['email' => 'qwe']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('WRONG EMAIL!!!!!!')
        ->and($fullMessage)->toBe('- WRONG EMAIL!!!!!!')
        ->and($messages)->toBe(['email' => 'WRONG EMAIL!!!!!!']),
));
