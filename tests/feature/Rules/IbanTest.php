<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::iban()->assert('SE35 5000 5880 7742'),
    fn(string $message) => expect($message)->toBe('"SE35 5000 5880 7742" must be a valid IBAN'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::iban())->assert('GB82 WEST 1234 5698 7654 32'),
    fn(string $message) => expect($message)->toBe('"GB82 WEST 1234 5698 7654 32" must not be a valid IBAN'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::iban()->assert('NOT AN IBAN'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "NOT AN IBAN" must be a valid IBAN'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::iban())->assert('HU93 1160 0006 0000 0000 1234 5676'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "HU93 1160 0006 0000 0000 1234 5676" must not be a valid IBAN'),
));
