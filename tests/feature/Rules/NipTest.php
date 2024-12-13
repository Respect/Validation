<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

test('Scenario #1', expectMessage(
    fn() => v::nip()->assert('1645865778'),
    '"1645865778" must be a valid Polish VAT identification number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::nip())->assert('1645865777'),
    '"1645865777" must not be a valid Polish VAT identification number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::nip()->assert('1645865778'),
    '- "1645865778" must be a valid Polish VAT identification number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::nip())->assert('1645865777'),
    '- "1645865777" must not be a valid Polish VAT identification number',
));
