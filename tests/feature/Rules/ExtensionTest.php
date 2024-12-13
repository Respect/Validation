<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::extension('png')->assert('filename.txt'),
    '"filename.txt" must have "png" extension',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::extension('gif'))->assert('filename.gif'),
    '"filename.gif" must not have "gif" extension',
));

test('Scenario #3', expectFullMessage(
    fn() => v::extension('mp3')->assert('filename.wav'),
    '- "filename.wav" must have "mp3" extension',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::extension('png'))->assert('tests/fixtures/invalid-image.png'),
    '- "tests/fixtures/invalid-image.png" must not have "png" extension',
));
