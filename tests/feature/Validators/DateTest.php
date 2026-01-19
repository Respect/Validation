<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Scenario #1', catchMessage(
    fn() => v::date()->assert('2018-01-29T08:32:54+00:00'),
    fn(string $message) => expect($message)->toBe('"2018-01-29T08:32:54+00:00" must be a valid date in the format "2005-12-30"'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::date())->assert('2018-01-29'),
    fn(string $message) => expect($message)->toBe('"2018-01-29" must not be a valid date in the format "2005-12-30"'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::date()->assert('2018-01-29T08:32:54+00:00'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "2018-01-29T08:32:54+00:00" must be a valid date in the format "2005-12-30"'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::date('d/m/Y'))->assert('29/01/2018'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "29/01/2018" must not be a valid date in the format "30/12/2005"'),
));
