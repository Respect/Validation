<?php

declare(strict_types=1);

test('Default: fail, fail', catchAll(
    fn() => v::anyOf(v::intType(), v::negative())->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - "string" must pass at least one of the rules
          - "string" must be an integer
          - "string" must be a negative number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"string" must pass at least one of the rules',
            'intType' => '"string" must be an integer',
            'negative' => '"string" must be a negative number',
        ]),
));

test('Inverted: pass, pass', catchAll(
    fn() => v::not(v::anyOf(v::intType(), v::negative()))->assert(-1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-1 must not be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - -1 must pass at least one of the rules
          - -1 must not be an integer
          - -1 must not be a negative number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '-1 must pass at least one of the rules',
            'intType' => '-1 must not be an integer',
            'negative' => '-1 must not be a negative number',
        ]),
));

test('Inverted: pass, pass, fail', catchAll(
    fn() => v::not(v::anyOf(v::intType(), v::negative(), v::stringType()))->assert(-1),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('-1 must not be an integer')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - -1 must pass at least one of the rules
          - -1 must not be an integer
          - -1 must not be a negative number
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '-1 must pass at least one of the rules',
            'intType' => '-1 must not be an integer',
            'negative' => '-1 must not be a negative number',
        ]),
));
