<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::json()->assert(false),
    fn(string $message) => expect($message)->toBe('`false` must be a valid JSON string'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::json())->assert('{"foo": "bar", "number":1}'),
    fn(string $message) => expect($message)->toBe('"{\\"foo\\": \\"bar\\", \\"number\\":1}" must not be a valid JSON string'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::json()->assert(new stdClass()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `stdClass {}` must be a valid JSON string'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::json())->assert('{}'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "{}" must not be a valid JSON string'),
));
