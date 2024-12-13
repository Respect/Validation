<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::iban()->assert('SE35 5000 5880 7742'),
    '"SE35 5000 5880 7742" must be a valid IBAN',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::iban())->assert('GB82 WEST 1234 5698 7654 32'),
    '"GB82 WEST 1234 5698 7654 32" must not be a valid IBAN',
));

test('Scenario #3', expectFullMessage(
    fn() => v::iban()->assert('NOT AN IBAN'),
    '- "NOT AN IBAN" must be a valid IBAN',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::iban())->assert('HU93 1160 0006 0000 0000 1234 5676'),
    '- "HU93 1160 0006 0000 0000 1234 5676" must not be a valid IBAN',
));
