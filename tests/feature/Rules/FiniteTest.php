<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::finite()->assert(''),
    fn(string $message) => expect($message)->toBe('"" must be a finite number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::finite())->assert(10),
    fn(string $message) => expect($message)->toBe('10 must not be a finite number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::finite()->assert([12]),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `[12]` must be a finite number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::finite())->assert('123456'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "123456" must not be a finite number'),
));
