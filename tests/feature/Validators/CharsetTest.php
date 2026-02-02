<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::charset('ASCII')->assert('açaí'),
    fn(string $message) => expect($message)->toBe('"açaí" must consist only of characters from the "ASCII" character-set'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::charset('UTF-8'))->assert('açaí'),
    fn(string $message) => expect($message)->toBe('"açaí" must not consist only of characters from the "UTF-8" character-set'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::charset('ASCII')->assert('açaí'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "açaí" must consist only of characters from the "ASCII" character-set'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::charset('UTF-8'))->assert('açaí'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "açaí" must not consist only of characters from the "UTF-8" character-set'),
));
