<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/739', catchAll(
    fn() => v::when(v::alwaysInvalid(), v::alwaysValid())->assert('foo'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"foo" is invalid')
        ->and($fullMessage)->toBe('- "foo" is invalid')
        ->and($messages)->toBe(['alwaysInvalid' => '"foo" is invalid'])
));
