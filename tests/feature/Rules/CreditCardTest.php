<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::creditCard('Discover')->assert(3566002020360505),
    fn(string $message) => expect($message)->toBe('3566002020360505 must be a valid Discover credit card number'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::creditCard('Visa'))->assert(4024007153361885),
    fn(string $message) => expect($message)->toBe('4024007153361885 must not be a valid Visa credit card number'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::creditCard('MasterCard')->assert(3566002020360505),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 3566002020360505 must be a valid MasterCard credit card number'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::creditCard())->assert(5555444433331111),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- 5555444433331111 must not be a valid credit card number'),
));
