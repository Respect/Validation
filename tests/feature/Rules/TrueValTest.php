<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::trueVal()->assert(false),
    '`false` must evaluate to `true`',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::trueVal())->assert(1),
    '1 must not evaluate to `true`',
));

test('Scenario #3', expectFullMessage(
    fn() => v::trueVal()->assert(0),
    '- 0 must evaluate to `true`',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::trueVal())->assert('true'),
    '- "true" must not evaluate to `true`',
));
