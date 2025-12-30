<?php

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::extension('png')->assert('filename.txt'),
    fn(string $message) => expect($message)->toBe('"filename.txt" must have "png" extension'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::extension('gif'))->assert('filename.gif'),
    fn(string $message) => expect($message)->toBe('"filename.gif" must not have "gif" extension'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::extension('mp3')->assert('filename.wav'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "filename.wav" must have "mp3" extension'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::extension('png'))->assert('tests/fixtures/invalid-image.png'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "tests/fixtures/invalid-image.png" must not have "png" extension'),
));
