<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Test\Stubs\CountableStub;

$input = 'http://www.google.com/search?q=respect.github.com';

test('https://github.com/Respect/Validation/issues/799 | #1', catchAll(
    fn() => v::init()
        ->call(
            [new CountableStub(1), 'count'],
            v::arrayVal()->key('scheme', v::startsWith('https')),
        )
        ->assert($input),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('1 must be an array value')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - 1 must pass all the rules
              - 1 must be an array value
              - `.scheme` must be present
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '1 must pass all the rules',
            'arrayVal' => '1 must be an array value',
            'scheme' => '`.scheme` must be present',
        ]),
));

test('https://github.com/Respect/Validation/issues/799 | #2', catchAll(
    fn() => v::init()
        ->call(
            fn($url) => parse_url((string) $url),
            v::arrayVal()->key('scheme', v::startsWith('https')),
        )
        ->assert($input),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.scheme` must start with "https"')
        ->and($fullMessage)->toBe('- `.scheme` must start with "https"')
        ->and($messages)->toBe(['scheme' => '`.scheme` must start with "https"']),
));
