<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/805', catchAll(
    fn() => v::key('email', v::templated(v::email(), 'WRONG EMAIL!!!!!!'))->assert(['email' => 'qwe']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('WRONG EMAIL!!!!!!')
        ->and($fullMessage)->toBe('- WRONG EMAIL!!!!!!')
        ->and($messages)->toBe(['email' => 'WRONG EMAIL!!!!!!']),
));
