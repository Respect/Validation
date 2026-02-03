<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::mimetype('image/png')->assert('image.png'),
    fn(string $message) => expect($message)->toBe('"image.png" must have the "image/png" MIME type'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::mimetype('image/png'))->assert('tests/fixtures/valid-image.png'),
    fn(string $message) => expect($message)->toBe('"tests/fixtures/valid-image.png" must not have the "image/png" MIME type'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::mimetype('image/png')->assert('tests/fixtures/invalid-image.png'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "tests/fixtures/invalid-image.png" must have the "image/png" MIME type'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::mimetype('image/png'))->assert('tests/fixtures/valid-image.png'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "tests/fixtures/valid-image.png" must not have the "image/png" MIME type'),
));
