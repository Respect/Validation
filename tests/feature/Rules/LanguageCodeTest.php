<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::languageCode()->assert(null),
    '`null` must be a valid language code',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::languageCode())->assert('pt'),
    '"pt" must not be a valid language code',
));

test('Scenario #3', expectFullMessage(
    fn() => v::languageCode()->assert('por'),
    '- "por" must be a valid language code',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::languageCode())->assert('en'),
    '- "en" must not be a valid language code',
));
