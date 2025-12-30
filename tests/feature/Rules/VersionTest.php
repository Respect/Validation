<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::version()->assert('1.3.7--'),
    fn(string $message) => expect($message)->toBe('"1.3.7--" must be a version'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::version())->assert('1.0.0-alpha'),
    fn(string $message) => expect($message)->toBe('"1.0.0-alpha" must not be a version'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::version()->assert('1.2.3.4-beta'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1.2.3.4-beta" must be a version'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::version())->assert('1.3.7-rc.1'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "1.3.7-rc.1" must not be a version'),
));
