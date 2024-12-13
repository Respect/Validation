<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::file()->assert('tests/fixtures/non-existent.sh'),
    '"tests/fixtures/non-existent.sh" must be a valid file',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::file())->assert('tests/fixtures/valid-image.png'),
    '"tests/fixtures/valid-image.png" must be an invalid file',
));

test('Scenario #3', expectFullMessage(
    fn() => v::file()->assert('tests/fixtures/non-existent.sh'),
    '- "tests/fixtures/non-existent.sh" must be a valid file',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::file())->assert('tests/fixtures/valid-image.png'),
    '- "tests/fixtures/valid-image.png" must be an invalid file',
));
