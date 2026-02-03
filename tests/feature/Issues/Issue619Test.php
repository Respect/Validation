<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/619', catchAll(
    fn() => v::templated('invalid object', v::instance(stdClass::class))->assert('test'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('invalid object')
        ->and($fullMessage)->toBe('- invalid object')
        ->and($messages)->toBe(['instance' => 'invalid object']),
));
