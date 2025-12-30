<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::not(v::no())->assert('No'),
    fn(string $message) => expect($message)->toBe('"No" must not be similar to "No"'),
));

test('Scenario #2', catchMessage(
    fn() => v::no()->assert('Yes'),
    fn(string $message) => expect($message)->toBe('"Yes" must be similar to "No"'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::not(v::no())->assert('No'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "No" must not be similar to "No"'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::no()->assert('Yes'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "Yes" must be similar to "No"'),
));
