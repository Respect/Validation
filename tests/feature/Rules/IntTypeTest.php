<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::intType()->assert(new stdClass()),
    fn(string $message) => expect($message)->toBe('`stdClass {}` must be an integer'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::intType())->assert(42),
    fn(string $message) => expect($message)->toBe('42 must not be an integer'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::intType()->assert(INF),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `INF` must be an integer'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::intType())->assert(1234567890),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 1234567890 must not be an integer'),
));
