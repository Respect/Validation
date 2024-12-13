<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::charset('ASCII')->assert('açaí'),
    '"açaí" must only contain characters from the `["ASCII"]` charset',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::charset('UTF-8'))->assert('açaí'),
    '"açaí" must not contain any characters from the `["UTF-8"]` charset',
));

test('Scenario #3', expectFullMessage(
    fn() => v::charset('ASCII')->assert('açaí'),
    '- "açaí" must only contain characters from the `["ASCII"]` charset',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::charset('UTF-8'))->assert('açaí'),
    '- "açaí" must not contain any characters from the `["UTF-8"]` charset',
));
