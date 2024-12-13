<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::nfeAccessKey()->assert('31841136830118868211870485416765268625116906'),
    '"31841136830118868211870485416765268625116906" must be a valid NFe access key',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::nfeAccessKey())->assert('52060433009911002506550120000007800267301615'),
    '"52060433009911002506550120000007800267301615" must not be a valid NFe access key',
));

test('Scenario #3', expectFullMessage(
    fn() => v::nfeAccessKey()->assert('31841136830118868211870485416765268625116906'),
    '- "31841136830118868211870485416765268625116906" must be a valid NFe access key',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::nfeAccessKey())->assert('52060433009911002506550120000007800267301615'),
    '- "52060433009911002506550120000007800267301615" must not be a valid NFe access key',
));
