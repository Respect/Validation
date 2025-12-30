<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::floatType()->assert('42.33'),
    fn(string $message) => expect($message)->toBe('"42.33" must be float'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::floatType())->assert(INF),
    fn(string $message) => expect($message)->toBe('`INF` must not be float'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::floatType()->assert(true),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `true` must be float'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::floatType())->assert(2.0),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 2.0 must not be float'),
));
