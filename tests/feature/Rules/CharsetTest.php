<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::charset('ASCII')->assert('açaí'),
    fn(string $message) => expect($message)->toBe('"açaí" must only contain characters from the `["ASCII"]` charset'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::charset('UTF-8'))->assert('açaí'),
    fn(string $message) => expect($message)->toBe('"açaí" must not contain any characters from the `["UTF-8"]` charset'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::charset('ASCII')->assert('açaí'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "açaí" must only contain characters from the `["ASCII"]` charset'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::charset('UTF-8'))->assert('açaí'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "açaí" must not contain any characters from the `["UTF-8"]` charset'),
));
