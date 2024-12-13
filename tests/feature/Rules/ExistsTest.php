<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::exists()->assert('/path/of/a/non-existent/file'),
    '"/path/of/a/non-existent/file" must be an existing file',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::exists())->assert('tests/fixtures/valid-image.gif'),
    '"tests/fixtures/valid-image.gif" must not be an existing file',
));

test('Scenario #3', expectFullMessage(
    fn() => v::exists()->assert('/path/of/a/non-existent/file'),
    '- "/path/of/a/non-existent/file" must be an existing file',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::exists())->assert('tests/fixtures/valid-image.png'),
    '- "tests/fixtures/valid-image.png" must not be an existing file',
));
