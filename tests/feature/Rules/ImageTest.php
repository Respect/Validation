<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::image()->assert('tests/fixtures/invalid-image.png'),
    '"tests/fixtures/invalid-image.png" must be a valid image file',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::image())->assert('tests/fixtures/valid-image.png'),
    '"tests/fixtures/valid-image.png" must not be a valid image file',
));

test('Scenario #3', expectFullMessage(
    fn() => v::image()->assert(new stdClass()),
    '- `stdClass {}` must be a valid image file',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::image())->assert('tests/fixtures/valid-image.gif'),
    '- "tests/fixtures/valid-image.gif" must not be a valid image file',
));
