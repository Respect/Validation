<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::file()->assert('tests/fixtures/non-existent.sh'),
    fn(string $message) => expect($message)->toBe('"tests/fixtures/non-existent.sh" must be a valid file'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::file())->assert('tests/fixtures/valid-image.png'),
    fn(string $message) => expect($message)->toBe('"tests/fixtures/valid-image.png" must be an invalid file'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::file()->assert('tests/fixtures/non-existent.sh'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "tests/fixtures/non-existent.sh" must be a valid file'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::file())->assert('tests/fixtures/valid-image.png'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "tests/fixtures/valid-image.png" must be an invalid file'),
));
