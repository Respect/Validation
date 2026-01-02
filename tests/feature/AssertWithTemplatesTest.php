<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Template as a string in the chain', catchAll(
    fn() => v::templated(v::alwaysInvalid(), 'My string template in the chain')->assert(1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('My string template in the chain')
        ->and($fullMessage)->toBe('- My string template in the chain')
        ->and($messages)->toBe(['alwaysInvalid' => 'My string template in the chain']),
));

test('Template as an array in the chain', catchAll(
    fn() => v::alwaysInvalid()->assert(1, ['alwaysInvalid' => 'My array template in the chain']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('My array template in the chain')
        ->and($fullMessage)->toBe('- My array template in the chain')
        ->and($messages)->toBe(['alwaysInvalid' => 'My array template in the chain']),
));

test('Runtime template as string', catchAll(
    fn() => v::alwaysInvalid()->assert(1, 'My runtime template as string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('My runtime template as string')
        ->and($fullMessage)->toBe('- My runtime template as string')
        ->and($messages)->toBe(['alwaysInvalid' => 'My runtime template as string']),
));

test('Runtime template as an array', catchAll(
    fn() => v::alwaysInvalid()->assert(1, ['alwaysInvalid' => 'My runtime template an array']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('My runtime template an array')
        ->and($fullMessage)->toBe('- My runtime template an array')
        ->and($messages)->toBe(['alwaysInvalid' => 'My runtime template an array']),
));
