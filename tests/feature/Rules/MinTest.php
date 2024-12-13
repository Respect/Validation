<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Default', expectAll(
    fn() => v::min(v::equals(1))->assert([2, 3]),
    'As the minimum from `[2, 3]`, 2 must be equal to 1',
    '- As the minimum from `[2, 3]`, 2 must be equal to 1',
    ['minEquals' => 'As the minimum from `[2, 3]`, 2 must be equal to 1']
));

test('Inverted', expectAll(
    fn() => v::not(v::min(v::equals(1)))->assert([1, 2, 3]),
    'As the minimum from `[1, 2, 3]`, 1 must not be equal to 1',
    '- As the minimum from `[1, 2, 3]`, 1 must not be equal to 1',
    ['notMinEquals' => 'As the minimum from `[1, 2, 3]`, 1 must not be equal to 1']
));

test('With template', expectAll(
    fn() => v::min(v::equals(1))->assert([2, 3], 'That did not go as planned'),
    'That did not go as planned',
    '- That did not go as planned',
    ['minEquals' => 'That did not go as planned']
));

test('With name', expectAll(
    fn() => v::min(v::equals(1))->setName('Options')->assert([2, 3]),
    'The minimum from Options must be equal to 1',
    '- The minimum from Options must be equal to 1',
    ['minEquals' => 'The minimum from Options must be equal to 1']
));
