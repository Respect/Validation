<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::uuid()->assert('g71a18f4-3a13-11e7-a919-92ebcb67fe33'),
    fn(string $message) => expect($message)->toBe('"g71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a UUID'),
));

test('Scenario #2', catchMessage(
    fn() => v::uuid(1)->assert('e0b5ffb9-9caf-2a34-9673-8fc91db78be6'),
    fn(string $message) => expect($message)->toBe('"e0b5ffb9-9caf-2a34-9673-8fc91db78be6" must be a UUID v1'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::uuid())->assert('fb3a7909-8034-59f5-8f38-21adbc168db7'),
    fn(string $message) => expect($message)->toBe('"fb3a7909-8034-59f5-8f38-21adbc168db7" must not be a UUID'),
));

test('Scenario #4', catchMessage(
    fn() => v::not(v::uuid(3))->assert('11a38b9a-b3da-360f-9353-a5a725514269'),
    fn(string $message) => expect($message)->toBe('"11a38b9a-b3da-360f-9353-a5a725514269" must not be a UUID v3'),
));

test('Scenario #5', catchFullMessage(
    fn() => v::uuid()->assert('g71a18f4-3a13-11e7-a919-92ebcb67fe33'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "g71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a UUID'),
));

test('Scenario #6', catchFullMessage(
    fn() => v::uuid(4)->assert('a71a18f4-3a13-11e7-a919-92ebcb67fe33'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "a71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a UUID v4'),
));

test('Scenario #7', catchFullMessage(
    fn() => v::not(v::uuid())->assert('e0b5ffb9-9caf-4a34-9673-8fc91db78be6'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "e0b5ffb9-9caf-4a34-9673-8fc91db78be6" must not be a UUID'),
));

test('Scenario #8', catchFullMessage(
    fn() => v::not(v::uuid(5))->assert('c4a760a8-dbcf-5254-a0d9-6a4474bd1b62'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "c4a760a8-dbcf-5254-a0d9-6a4474bd1b62" must not be a UUID v5'),
));
