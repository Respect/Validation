<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1244', catchAll(
    fn() => v::key('firstname', v::named(v::notBlank(), 'First Name'))->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('First Name must be present')
        ->and($fullMessage)->toBe('- First Name must be present')
        ->and($messages)->toBe(['firstname' => 'First Name must be present']),
));
