<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/619', catchAll(
    fn() => v::instance(stdClass::class)->setTemplate('invalid object')->assert('test'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('invalid object')
        ->and($fullMessage)->toBe('- invalid object')
        ->and($messages)->toBe(['instance' => 'invalid object']),
));
