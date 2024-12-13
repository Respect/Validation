<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::notEmoji()->assert('🍕'),
    '"🍕" must not contain an emoji',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::notEmoji())->assert('AB'),
    '"AB" must contain an emoji',
));

test('Scenario #3', expectFullMessage(
    fn() => v::notEmoji()->assert('🏄'),
    '- "🏄" must not contain an emoji',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::notEmoji())->assert('YZ'),
    '- "YZ" must contain an emoji',
));
