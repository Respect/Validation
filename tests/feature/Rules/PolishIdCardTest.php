<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

test('Scenario #1', expectMessage(
    fn() => v::polishIdCard()->assert('AYE205411'),
    '"AYE205411" must be a valid Polish Identity Card number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::polishIdCard())->assert('AYE205410'),
    '"AYE205410" must not be a valid Polish Identity Card number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::polishIdCard()->assert('AYE205411'),
    '- "AYE205411" must be a valid Polish Identity Card number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::polishIdCard())->assert('AYE205410'),
    '- "AYE205410" must not be a valid Polish Identity Card number',
));
