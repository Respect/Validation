<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::nullType()->assert(''),
    fn(string $message) => expect($message)->toBe('"" must be null'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::nullType())->assert(null),
    fn(string $message) => expect($message)->toBe('`null` must not be null'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::nullType()->assert(false),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `false` must be null'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::nullType())->assert(null),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `null` must not be null'),
));
