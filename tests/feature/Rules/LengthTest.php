<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::length(v::equals(3))->assert('tulip'),
    'The length of "tulip" must be equal to 3',
    '- The length of "tulip" must be equal to 3',
    ['lengthEquals' => 'The length of "tulip" must be equal to 3'],
));

test('Inverted wrapped', expectAll(
    fn() => v::length(v::not(v::equals(4)))->assert('rose'),
    'The length of "rose" must not be equal to 4',
    '- The length of "rose" must not be equal to 4',
    ['lengthNotEquals' => 'The length of "rose" must not be equal to 4'],
));

test('Inverted wrapper', expectAll(
    fn() => v::not(v::length(v::equals(4)))->assert('fern'),
    'The length of "fern" must not be equal to 4',
    '- The length of "fern" must not be equal to 4',
    ['notLengthEquals' => 'The length of "fern" must not be equal to 4'],
));

test('With template', expectAll(
    fn() => v::length(v::equals(3))->assert('azalea', 'This is a template'),
    'This is a template',
    '- This is a template',
    ['lengthEquals' => 'This is a template'],
));

test('With wrapper name', expectAll(
    fn() => v::length(v::equals(3))->setName('Cactus')->assert('peyote'),
    'The length of Cactus must be equal to 3',
    '- The length of Cactus must be equal to 3',
    ['lengthEquals' => 'The length of Cactus must be equal to 3'],
));

test('Chained wrapped rule', expectAll(
    fn() => v::length(v::between(5, 7)->odd())->assert([]),
    'The length of `[]` must be between 5 and 7',
    <<<'FULL_MESSAGE'
    - `[]` must pass all the rules
      - The length of `[]` must be between 5 and 7
      - The length of `[]` must be an odd number
    FULL_MESSAGE,
    [
        '__root__' => '`[]` must pass all the rules',
        'lengthBetween' => 'The length of `[]` must be between 5 and 7',
        'lengthOdd' => 'The length of `[]` must be an odd number',
    ],
));
