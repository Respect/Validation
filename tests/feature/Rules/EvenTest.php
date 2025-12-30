<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::even()->assert(-1),
    fn(string $message) => expect($message)->toBe('-1 must be an even number'),
));

test('Scenario #2', catchFullMessage(
    fn() => v::even()->assert(5),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 5 must be an even number'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::even())->assert(6),
    fn(string $message) => expect($message)->toBe('6 must be an odd number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::even())->assert(8),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 8 must be an odd number'),
));
