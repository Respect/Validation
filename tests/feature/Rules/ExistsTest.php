<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::exists()->assert('/path/of/a/non-existent/file'),
    fn(string $message) => expect($message)->toBe('"/path/of/a/non-existent/file" must be an existing file'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::exists())->assert('tests/fixtures/valid-image.gif'),
    fn(string $message) => expect($message)->toBe('"tests/fixtures/valid-image.gif" must not be an existing file'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::exists()->assert('/path/of/a/non-existent/file'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "/path/of/a/non-existent/file" must be an existing file'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::exists())->assert('tests/fixtures/valid-image.png'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "tests/fixtures/valid-image.png" must not be an existing file'),
));
