<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::uppercase()->assert('lowercase'),
    fn(string $message) => expect($message)->toBe('"lowercase" must contain only uppercase letters'),
));

test('Scenario #2', catchFullMessage(
    fn() => v::uppercase()->assert('lowercase'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "lowercase" must contain only uppercase letters'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::uppercase())->assert('UPPERCASE'),
    fn(string $message) => expect($message)->toBe('"UPPERCASE" must not contain only uppercase letters'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::uppercase())->assert('UPPERCASE'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "UPPERCASE" must not contain only uppercase letters'),
));
