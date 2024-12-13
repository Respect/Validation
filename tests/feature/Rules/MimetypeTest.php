<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::mimetype('image/png')->assert('image.png'),
    '"image.png" must have the "image/png" MIME type',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::mimetype('image/png'))->assert('tests/fixtures/valid-image.png'),
    '"tests/fixtures/valid-image.png" must not have the "image/png" MIME type',
));

test('Scenario #3', expectFullMessage(
    fn() => v::mimetype('image/png')->assert('tests/fixtures/invalid-image.png'),
    '- "tests/fixtures/invalid-image.png" must have the "image/png" MIME type',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::mimetype('image/png'))->assert('tests/fixtures/valid-image.png'),
    '- "tests/fixtures/valid-image.png" must not have the "image/png" MIME type',
));
