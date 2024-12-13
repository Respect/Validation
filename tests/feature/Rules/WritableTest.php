<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::writable()->assert('/path/of/a/valid/writable/file.txt'),
    '"/path/of/a/valid/writable/file.txt" must be writable',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::writable())->assert('tests/fixtures/valid-image.png'),
    '"tests/fixtures/valid-image.png" must not be writable',
));

test('Scenario #3', expectFullMessage(
    fn() => v::writable()->assert([]),
    '- `[]` must be writable',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::writable())->assert('tests/fixtures/invalid-image.png'),
    '- "tests/fixtures/invalid-image.png" must not be writable',
));
