<?php

declare(strict_types=1);

test('https://github.com/Respect/Validation/issues/1244', catchAll(
    fn() => v::key('firstname', v::notBlank()->setName('First Name'))->assert([]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('First Name must be present')
        ->and($fullMessage)->toBe('- First Name must be present')
        ->and($messages)->toBe(['firstname' => 'First Name must be present']),
));
