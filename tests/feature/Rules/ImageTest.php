<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::image()->assert('tests/fixtures/invalid-image.png'),
    fn(string $message) => expect($message)->toBe('"tests/fixtures/invalid-image.png" must be a valid image file'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::image())->assert('tests/fixtures/valid-image.png'),
    fn(string $message) => expect($message)->toBe('"tests/fixtures/valid-image.png" must not be a valid image file'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::image()->assert(new stdClass()),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- `stdClass {}` must be a valid image file'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::image())->assert('tests/fixtures/valid-image.gif'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "tests/fixtures/valid-image.gif" must not be a valid image file'),
));
