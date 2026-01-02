<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', catchAll(
    fn() => v::hetu()->assert('010106A901O'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"010106A901O" must be a valid Finnish personal identity code')
        ->and($fullMessage)->toBe('- "010106A901O" must be a valid Finnish personal identity code')
        ->and($messages)->toBe(['hetu' => '"010106A901O" must be a valid Finnish personal identity code']),
));

test('Inverted', catchAll(
    fn() => v::not(v::hetu())->assert('010106A9012'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"010106A9012" must not be a valid Finnish personal identity code')
        ->and($fullMessage)->toBe('- "010106A9012" must not be a valid Finnish personal identity code')
        ->and($messages)->toBe(['notHetu' => '"010106A9012" must not be a valid Finnish personal identity code']),
));

test('With template', catchAll(
    fn() => v::hetu()->assert('010106A901O', 'That is not a HETU'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('That is not a HETU')
        ->and($fullMessage)->toBe('- That is not a HETU')
        ->and($messages)->toBe(['hetu' => 'That is not a HETU']),
));

test('With name', catchAll(
    fn() => v::named(v::hetu(), 'Hetu')->assert('010106A901O'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Hetu must be a valid Finnish personal identity code')
        ->and($fullMessage)->toBe('- Hetu must be a valid Finnish personal identity code')
        ->and($messages)->toBe(['hetu' => 'Hetu must be a valid Finnish personal identity code']),
));
