<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Non-iterable', catchAll(
    fn() => v::eachKey(v::stringType())->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`null` must be iterable')
        ->and($fullMessage)->toBe('- `null` must be iterable')
        ->and($messages)->toBe(['eachKey' => '`null` must be iterable']),
));

test('Default', catchAll(
    fn() => v::eachKey(v::stringType())->assert([0 => 'a', 1 => 'b', 2 => 'c']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Key `.0` must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each key of `["a", "b", "c"]` must be valid
          - Key `.0` must be a string
          - Key `.1` must be a string
          - Key `.2` must be a string
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each key of `["a", "b", "c"]` must be valid',
            0 => 'Key `.0` must be a string',
            1 => 'Key `.1` must be a string',
            2 => 'Key `.2` must be a string',
        ]),
));

test('Inverted', catchAll(
    fn() => v::not(v::eachKey(v::stringType()))->assert(['a' => 1, 'b' => 2, 'c' => 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Key `.a` must not be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each key of `["a": 1, "b": 2, "c": 3]` must be invalid
          - Key `.a` must not be a string
          - Key `.b` must not be a string
          - Key `.c` must not be a string
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each key of `["a": 1, "b": 2, "c": 3]` must be invalid',
            'a' => 'Key `.a` must not be a string',
            'b' => 'Key `.b` must not be a string',
            'c' => 'Key `.c` must not be a string',
        ]),
));

test('With name, default', catchAll(
    fn() => v::named('Outer', v::eachKey(v::named('Inner', v::stringType())))->assert([0 => 'a', 1 => 'b', 2 => 'c']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Key Inner must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each key of Outer must be valid
          - Key `.0` must be a string
          - Key `.1` must be a string
          - Key `.2` must be a string
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each key of Outer must be valid',
            0 => 'Key `.0` must be a string',
            1 => 'Key `.1` must be a string',
            2 => 'Key `.2` must be a string',
        ]),
));

test('With name, inverted', catchAll(
    fn() => v::named('Not', v::not(v::named('Outer', v::eachKey(v::named('Inner', v::stringType())))))->assert(['a' => 1, 'b' => 2, 'c' => 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Key Inner must not be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each key of Outer must be invalid
          - Key `.a` must not be a string
          - Key `.b` must not be a string
          - Key `.c` must not be a string
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each key of Outer must be invalid',
            'a' => 'Key `.a` must not be a string',
            'b' => 'Key `.b` must not be a string',
            'c' => 'Key `.c` must not be a string',
        ]),
));

test('With wrapper name, default', catchAll(
    fn() => v::named('Wrapper', v::eachKey(v::stringType()))->assert([0 => 'a', 1 => 'b', 2 => 'c']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Key `.0` (<- Wrapper) must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each key of Wrapper must be valid
          - Key `.0` must be a string
          - Key `.1` must be a string
          - Key `.2` must be a string
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each key of Wrapper must be valid',
            0 => 'Key `.0` must be a string',
            1 => 'Key `.1` must be a string',
            2 => 'Key `.2` must be a string',
        ]),
));

test('With Not name, inverted', catchAll(
    fn() => v::named('Not', v::not(v::eachKey(v::stringType())))->assert(['a' => 1, 'b' => 2, 'c' => 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Key `.a` (<- Not) must not be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each key of Not must be invalid
          - Key `.a` must not be a string
          - Key `.b` must not be a string
          - Key `.c` must not be a string
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each key of Not must be invalid',
            'a' => 'Key `.a` must not be a string',
            'b' => 'Key `.b` must not be a string',
            'c' => 'Key `.c` must not be a string',
        ]),
));

test('With template, non-iterable', catchAll(
    fn() => v::templated('You should have passed an iterable', v::eachKey(v::stringType()))->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('You should have passed an iterable')
        ->and($fullMessage)->toBe('- You should have passed an iterable')
        ->and($messages)->toBe(['eachKey' => 'You should have passed an iterable']),
));

test('With template, default', catchAll(
    fn() => v::templated('All keys should have been strings', v::eachKey(v::stringType()))
        ->assert([0 => 'a', 1 => 'b', 2 => 'c']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('All keys should have been strings')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - All keys should have been strings
              - Key `.0` must be a string
              - Key `.1` must be a string
              - Key `.2` must be a string
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'All keys should have been strings',
            0 => 'Key `.0` must be a string',
            1 => 'Key `.1` must be a string',
            2 => 'Key `.2` must be a string',
        ]),
));

test('with template, inverted', catchAll(
    fn() => v::templated('All keys should not have been strings', v::not(v::eachKey(v::stringType())))
        ->assert(['a' => 1, 'b' => 2, 'c' => 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('All keys should not have been strings')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
            - All keys should not have been strings
              - Key `.a` must not be a string
              - Key `.b` must not be a string
              - Key `.c` must not be a string
            FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'All keys should not have been strings',
            'a' => 'Key `.a` must not be a string',
            'b' => 'Key `.b` must not be a string',
            'c' => 'Key `.c` must not be a string',
        ]),
));

test('With array template, default', catchAll(
    fn() => v::eachKey(v::stringType())
        ->assert([0 => 'a', 1 => 'b', 2 => 'c'], [
            '__root__' => 'Here the keys that did not pass the validation',
            0 => 'First key should have been a string',
            1 => 'Second key should have been a string',
            2 => 'Third key should have been a string',
        ]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('First key should have been a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Here the keys that did not pass the validation
          - First key should have been a string
          - Second key should have been a string
          - Third key should have been a string
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Here the keys that did not pass the validation',
            0 => 'First key should have been a string',
            1 => 'Second key should have been a string',
            2 => 'Third key should have been a string',
        ]),
));

test('short-circuit: first key fails', catchAll(
    fn() => v::shortCircuit(v::eachKey(v::stringType()))->assert([0 => 'a', 1 => 'b', 2 => 'c']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Key `.0` must be a string')
        ->and($fullMessage)->toBe('- Key `.0` must be a string')
        ->and($messages)->toBe([0 => 'Key `.0` must be a string']),
));

test('short-circuit: all keys pass', function (): void {
    $validator = v::shortCircuit(v::eachKey(v::stringType()));
    expect($validator->isValid(['a' => 1, 'b' => 2]))->toBeTrue();
});

test('short-circuit: empty array', function (): void {
    $validator = v::shortCircuit(v::eachKey(v::stringType()));
    expect($validator->isValid([]))->toBeTrue();
});

test('short-circuit: non-iterable input', catchAll(
    fn() => v::shortCircuit(v::eachKey(v::stringType()))->assert(null),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`null` must be iterable')
        ->and($fullMessage)->toBe('- `null` must be iterable')
        ->and($messages)->toBe(['eachKey' => '`null` must be iterable']),
));

test('short-circuit: with wrapper name', catchAll(
    fn() => v::named('Wrapper', v::shortCircuit(v::eachKey(v::stringType())))->assert([0 => 'a', 1 => 'b', 2 => 'c']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Key `.0` (<- Wrapper) must be a string')
        ->and($fullMessage)->toBe('- Key `.0` (<- Wrapper) must be a string')
        ->and($messages)->toBe([0 => 'Key `.0` (<- Wrapper) must be a string']),
));

test('short-circuit: with inner name', catchAll(
    fn() => v::shortCircuit(v::eachKey(v::named('Inner', v::stringType())))->assert([0 => 'a', 1 => 'b', 2 => 'c']),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Key Inner must be a string')
        ->and($fullMessage)->toBe('- Key Inner must be a string')
        ->and($messages)->toBe([0 => 'Key Inner must be a string']),
));

test('short-circuit: with key() composition', catchAll(
    fn() => v::key('data', v::shortCircuit(v::eachKey(v::stringType())))->assert(['data' => [0 => 'a', 1 => 'b']]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Key `.data.0` must be a string')
        ->and($fullMessage)->toBe('- Key `.data.0` must be a string')
        ->and($messages)->toBe([0 => 'Key `.data.0` must be a string']),
));

test('short-circuit: SplObjectStorage', catchAll(
    fn() => v::shortCircuit(v::eachKey(v::stringType()))->assert((function () {
        $storage = new SplObjectStorage();
        $storage[new stdClass()] = 'a';
        $storage[new stdClass()] = 'b';

        return $storage;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Key `.0` must be a string')
        ->and($fullMessage)->toBe('- Key `.0` must be a string')
        ->and($messages)->toBe([0 => 'Key `.0` must be a string']),
));

test('SplObjectStorage keys are integers', catchAll(
    fn() => v::eachKey(v::stringType())->assert((function () {
        $storage = new SplObjectStorage();
        $storage[new stdClass()] = 'a';
        $storage[new stdClass()] = 'b';
        $storage[new stdClass()] = 'c';

        return $storage;
    })()),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Key `.0` must be a string')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - Each key of `[stdClass {}, stdClass {}, stdClass {}]` must be valid
          - Key `.0` must be a string
          - Key `.1` must be a string
          - Key `.2` must be a string
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => 'Each key of `[stdClass {}, stdClass {}, stdClass {}]` must be valid',
            0 => 'Key `.0` must be a string',
            1 => 'Key `.1` must be a string',
            2 => 'Key `.2` must be a string',
        ]),
));
