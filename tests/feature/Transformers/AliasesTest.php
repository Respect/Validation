<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Optional', catchAll(
    fn() => v::optional(v::scalarVal())->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`[]` must be a scalar value or must be undefined')
        ->and($fullMessage)->toBe('- `[]` must be a scalar value or must be undefined')
        ->and($messages)->toBe(['undefOrScalarVal' => '`[]` must be a scalar value or must be undefined'])
));
