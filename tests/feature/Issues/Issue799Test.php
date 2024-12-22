<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Test\Stubs\CountableStub;

$input = 'http://www.google.com/search?q=respect.github.com';

test('https://github.com/Respect/Validation/issues/799 | #1', expectAll(
    fn() => v::create()
        ->call(
            [new CountableStub(1), 'count'],
            v::arrayVal()->key('scheme', v::startsWith('https')),
        )
        ->assert($input),
    '1 must be an array value',
    <<<'FULL_MESSAGE'
    - All the required rules must pass for 1
      - 1 must be an array value
      - scheme must be present
    FULL_MESSAGE,
    [
        '__root__' => 'All the required rules must pass for 1',
        'arrayVal' => '1 must be an array value',
        'scheme' => 'scheme must be present',
    ],
));

test('https://github.com/Respect/Validation/issues/799 | #2', expectAll(
    fn() => v::create()
        ->call(
            fn ($url) => parse_url($url),
            v::arrayVal()->key('scheme', v::startsWith('https')),
        )
        ->assert($input),
    'scheme must start with "https"',
    '- scheme must start with "https"',
    ['scheme' => 'scheme must start with "https"'],
));
