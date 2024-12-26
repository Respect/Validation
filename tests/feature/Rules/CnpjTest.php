<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

test('Scenario #1', expectMessage(
    fn() => v::cnpj()->assert('não cnpj'),
    '"não cnpj" must be a valid CNPJ number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::cnpj())->assert('65.150.175/0001-20'),
    '"65.150.175/0001-20" must not be a valid CNPJ number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::cnpj()->assert('test'),
    '- "test" must be a valid CNPJ number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::cnpj())->assert('65.150.175/0001-20'),
    '- "65.150.175/0001-20" must not be a valid CNPJ number',
));
