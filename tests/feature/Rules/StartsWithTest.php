<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::startsWith('b')->assert(['a', 'b']),
    fn(string $message) => expect($message)->toBe('`["a", "b"]` must start with "b"'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::startsWith(1.1))->assert([1.1, 2.2]),
    fn(string $message) => expect($message)->toBe('`[1.1, 2.2]` must not start with 1.1'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::startsWith('3.3', true)->assert([3.3, 4.4]),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `[3.3, 4.4]` must start with "3.3"'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::startsWith('c'))->assert(['c', 'd']),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `["c", "d"]` must not start with "c"'),
));
