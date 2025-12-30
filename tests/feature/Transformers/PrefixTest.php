<?php

declare(strict_types=1);

date_default_timezone_set('UTC');

test('Key', catchAll(
    fn() => v::keyEquals('foo', 12)->assert(['foo' => 10]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must be equal to 12')
        ->and($fullMessage)->toBe('- `.foo` must be equal to 12')
        ->and($messages)->toBe(['foo' => '`.foo` must be equal to 12']),
));

test('Length', catchAll(
    fn() => v::lengthGreaterThan(3)->assert('foo'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The length of "foo" must be greater than 3')
        ->and($fullMessage)->toBe('- The length of "foo" must be greater than 3')
        ->and($messages)->toBe(['lengthGreaterThan' => 'The length of "foo" must be greater than 3']),
));

test('Max', catchAll(
    fn() => v::maxOdd()->assert([1, 2, 3, 4]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The maximum of `[1, 2, 3, 4]` must be an odd number')
        ->and($fullMessage)->toBe('- The maximum of `[1, 2, 3, 4]` must be an odd number')
        ->and($messages)->toBe(['maxOdd' => 'The maximum of `[1, 2, 3, 4]` must be an odd number']),
));

test('Min', catchAll(
    fn() => v::minEven()->assert([1, 2, 3]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The minimum of `[1, 2, 3]` must be an even number')
        ->and($fullMessage)->toBe('- The minimum of `[1, 2, 3]` must be an even number')
        ->and($messages)->toBe(['minEven' => 'The minimum of `[1, 2, 3]` must be an even number']),
));

test('Not', catchAll(
    fn() => v::notBetween(1, 3)->assert(2),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('2 must not be between 1 and 3')
        ->and($fullMessage)->toBe('- 2 must not be between 1 and 3')
        ->and($messages)->toBe(['notBetween' => '2 must not be between 1 and 3']),
));

test('NullOr', catchAll(
    fn() => v::nullOrBoolType()->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must be a boolean or must be null')
        ->and($fullMessage)->toBe('- "string" must be a boolean or must be null')
        ->and($messages)->toBe(['nullOrBoolType' => '"string" must be a boolean or must be null']),
));

test('Property', catchAll(
    fn() => v::propertyBetween('foo', 1, 3)->assert((object) ['foo' => 5]),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('`.foo` must be between 1 and 3')
        ->and($fullMessage)->toBe('- `.foo` must be between 1 and 3')
        ->and($messages)->toBe(['foo' => '`.foo` must be between 1 and 3']),
));

test('UndefOr', catchAll(
    fn() => v::undefOrUrl()->assert('string'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"string" must be a URL or must be undefined')
        ->and($fullMessage)->toBe('- "string" must be a URL or must be undefined')
        ->and($messages)->toBe(['undefOrUrl' => '"string" must be a URL or must be undefined']),
));
