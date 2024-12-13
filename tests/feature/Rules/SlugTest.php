<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::slug()->assert('my-Slug'),
    '"my-Slug" must be a valid slug',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::slug())->assert('my-slug'),
    '"my-slug" must not be a valid slug',
));

test('Scenario #3', expectFullMessage(
    fn() => v::slug()->assert('my-Slug'),
    '- "my-Slug" must be a valid slug',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::slug())->assert('my-slug'),
    '- "my-slug" must not be a valid slug',
));
