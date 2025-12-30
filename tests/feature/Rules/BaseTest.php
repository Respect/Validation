<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::base(61)->assert('Z01xSsg5675hic20dj'),
    fn(string $message) => expect($message)->toBe('"Z01xSsg5675hic20dj" must be a number in base 61'),
));

test('Scenario #2', catchFullMessage(
    fn() => v::base(2)->assert(''),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "" must be a number in base 2'),
));

test('Scenario #3', catchMessage(
    fn() => v::not(v::base(2))->assert('011010001'),
    fn(string $message) => expect($message)->toBe('"011010001" must not be a number in base 2'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::base(2))->assert('011010001'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "011010001" must not be a number in base 2'),
));
