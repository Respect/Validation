<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::greaterThanOrEqual(INF)->assert(10),
    fn(string $message) => expect($message)->toBe('10 must be greater than or equal to `INF`'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::greaterThanOrEqual(5))->assert(INF),
    fn(string $message) => expect($message)->toBe('`INF` must be less than 5'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::greaterThanOrEqual('today')->assert('yesterday'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "yesterday" must be greater than or equal to "today"'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::greaterThanOrEqual('a'))->assert('z'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "z" must be less than "a"'),
));
