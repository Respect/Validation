<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::containsAny(['foo', 'bar'])->assert('baz'),
    fn(string $message) => expect($message)->toBe('"baz" must contain at least one value from `["foo", "bar"]`'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::containsAny(['foo', 'bar']))->assert('fool'),
    fn(string $message) => expect($message)->toBe('"fool" must not contain any value from `["foo", "bar"]`'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::containsAny(['foo', 'bar'])->assert(['baz']),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `["baz"]` must contain at least one value from `["foo", "bar"]`'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::containsAny(['foo', 'bar'], true))->assert(['bar', 'foo']),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `["bar", "foo"]` must not contain any value from `["foo", "bar"]`'),
));
