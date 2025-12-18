<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

require_once 'vendor/autoload.php';

test('Scenario #1', catchMessage(
    fn() => v::cnpj()->assert('não cnpj'),
    fn(string $message) => expect($message)->toBe('"não cnpj" must be a valid CNPJ number')
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::cnpj())->assert('65.150.175/0001-20'),
    fn(string $message) => expect($message)->toBe('"65.150.175/0001-20" must not be a valid CNPJ number')
));

test('Scenario #3', catchFullMessage(
    fn() => v::cnpj()->assert('test'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "test" must be a valid CNPJ number')
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::cnpj())->assert('65.150.175/0001-20'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "65.150.175/0001-20" must not be a valid CNPJ number')
));
