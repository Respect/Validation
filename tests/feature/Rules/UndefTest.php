<?php

declare(strict_types=1);

test('default template', catchAll(
    fn() => v::undef()->assert(false),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`false` must be undefined')
        ->and($fullMessage)->toBe('- `false` must be undefined')
        ->and($messages)->toBe(['undef' => '`false` must be undefined']),
));

test('inverted template', catchAll(
    fn() => v::not(v::undef())->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`null` must be defined')
        ->and($fullMessage)->toBe('- `null` must be defined')
        ->and($messages)->toBe(['notUndef' => '`null` must be defined']),
));
