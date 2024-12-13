<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::identical(123)->assert(321),
    '321 must be identical to 123',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::identical(321))->assert(321),
    '321 must not be identical to 321',
));

test('Scenario #3', expectFullMessage(
    fn() => v::identical(123)->assert(321),
    '- 321 must be identical to 123',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::identical(321))->assert(321),
    '- 321 must not be identical to 321',
));
