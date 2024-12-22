<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('When valid use "then"', expectAll(
    fn() => v::when(v::intVal(), v::positive(), v::notEmpty())->assert(-1),
    '-1 must be a positive number',
    '- -1 must be a positive number',
    ['positive' => '-1 must be a positive number'],
));

test('When invalid use "else"', expectAll(
    fn() => v::when(v::intVal(), v::positive(), v::notEmpty())->assert(''),
    '"" must not be empty',
    '- "" must not be empty',
    ['notEmpty' => '"" must not be empty'],
));

test('When valid use "then" using single template', expectAll(
    fn() => v::when(v::intVal(), v::positive(), v::notEmpty())->assert(-1, 'That did not go as planned'),
    'That did not go as planned',
    '- That did not go as planned',
    ['positive' => 'That did not go as planned'],
));

test('When invalid use "else" using single template', expectAll(
    fn() => v::when(v::intVal(), v::positive(), v::notEmpty())->assert('', 'That could have been better'),
    'That could have been better',
    '- That could have been better',
    ['notEmpty' => 'That could have been better'],
));

test('When valid use "then" using array template', expectAll(
    fn() => v::when(v::intVal(), v::positive(), v::notEmpty())->assert(-1, [
        'notEmpty' => '--Never shown--',
        'positive' => 'Not positive',
    ]),
    'Not positive',
    '- Not positive',
    ['positive' => 'Not positive'],
));

test('When invalid use "else" using array template', expectAll(
    fn() => v::when(v::intVal(), v::positive(), v::notEmpty())->assert('', [
        'notEmpty' => 'Not empty',
        'positive' => '--Never shown--',
    ]),
    'Not empty',
    '- Not empty',
    ['notEmpty' => 'Not empty'],
));
