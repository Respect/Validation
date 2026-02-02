<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::after('trim', v::notSpaced())->assert(' two words '),
    fn(string $message) => expect($message)->toBe('"two words" must not contain whitespace'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::after('stripslashes', v::stringType()))->assert(' some\thing '),
    fn(string $message) => expect($message)->toBe('" something " must not be a string'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::after('strval', v::intType())->assert(1234),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1234" must be an integer'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::after('is_float', v::boolType()))->assert(1.2),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `true` must not be a boolean'),
));
