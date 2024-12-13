<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::symbolicLink()->assert('tests/fixtures/fake-filename'),
    '"tests/fixtures/fake-filename" must be a symbolic link',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::symbolicLink())->assert('tests/fixtures/symbolic-link'),
    '"tests/fixtures/symbolic-link" must not be a symbolic link',
));

test('Scenario #3', expectFullMessage(
    fn() => v::symbolicLink()->assert('tests/fixtures/fake-filename'),
    '- "tests/fixtures/fake-filename" must be a symbolic link',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::symbolicLink())->assert('tests/fixtures/symbolic-link'),
    '- "tests/fixtures/symbolic-link" must not be a symbolic link',
));
