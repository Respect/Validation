<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::readable()->assert('tests/fixtures/invalid-image.jpg'),
    '"tests/fixtures/invalid-image.jpg" must be readable',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::readable())->assert('tests/fixtures/valid-image.png'),
    '"tests/fixtures/valid-image.png" must not be readable',
));

test('Scenario #3', expectFullMessage(
    fn() => v::readable()->assert(new stdClass()),
    '- `stdClass {}` must be readable',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::readable())->assert('tests/fixtures/valid-image.png'),
    '- "tests/fixtures/valid-image.png" must not be readable',
));
