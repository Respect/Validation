<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::min(v::equals(1))->assert([2, 3]),
    'The minimum of `[2, 3]` must be equal to 1',
    '- The minimum of `[2, 3]` must be equal to 1',
    ['minEquals' => 'The minimum of `[2, 3]` must be equal to 1']
));

test('Inverted', expectAll(
    fn() => v::not(v::min(v::equals(1)))->assert([1, 2, 3]),
    'The minimum of `[1, 2, 3]` must not be equal to 1',
    '- The minimum of `[1, 2, 3]` must not be equal to 1',
    ['notMinEquals' => 'The minimum of `[1, 2, 3]` must not be equal to 1']
));

test('With template', expectAll(
    fn() => v::min(v::equals(1))->assert([2, 3], 'That did not go as planned'),
    'That did not go as planned',
    '- That did not go as planned',
    ['minEquals' => 'That did not go as planned']
));

test('With name', expectAll(
    fn() => v::min(v::equals(1))->setName('Options')->assert([2, 3]),
    'The minimum of Options must be equal to 1',
    '- The minimum of Options must be equal to 1',
    ['minEquals' => 'The minimum of Options must be equal to 1']
));

test('Chained wrapped rule', expectAll(
    fn() => v::min(v::between(5, 7)->odd())->assert([2, 3, 4]),
    'The minimum of `[2, 3, 4]` must be between 5 and 7',
    <<<'FULL_MESSAGE'
    - All of the required rules must pass for `[2, 3, 4]`
      - The minimum of `[2, 3, 4]` must be between 5 and 7
      - The minimum of `[2, 3, 4]` must be an odd number
    FULL_MESSAGE,
    [
        '__root__' => 'All of the required rules must pass for `[2, 3, 4]`',
        'minBetween' => 'The minimum of `[2, 3, 4]` must be between 5 and 7',
        'minOdd' => 'The minimum of `[2, 3, 4]` must be an odd number',
    ]
));
