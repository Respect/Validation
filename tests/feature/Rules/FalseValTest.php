<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::falseVal()->assert(true),
    '`true` must evaluate to `false`',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::falseVal())->assert('false'),
    '"false" must not evaluate to `false`',
));

test('Scenario #3', expectFullMessage(
    fn() => v::falseVal()->assert(1),
    '- 1 must evaluate to `false`',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::falseVal())->assert(0),
    '- 0 must not evaluate to `false`',
));
