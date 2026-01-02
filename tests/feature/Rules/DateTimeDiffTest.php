<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('With $type = "years"', catchAll(
    fn() => v::dateTimeDiff('years', v::equals(2))->assert('1 year ago'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The number of years between now and "1 year ago" must be equal to 2')
        ->and($fullMessage)->toBe('- The number of years between now and "1 year ago" must be equal to 2')
        ->and($messages)->toBe(['dateTimeDiffEquals' => 'The number of years between now and "1 year ago" must be equal to 2']),
));

test('With $type = "months"', catchAll(
    fn() => v::dateTimeDiff('months', v::equals(3))->assert('2 months ago'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The number of months between now and "2 months ago" must be equal to 3')
        ->and($fullMessage)->toBe('- The number of months between now and "2 months ago" must be equal to 3')
        ->and($messages)->toBe(['dateTimeDiffEquals' => 'The number of months between now and "2 months ago" must be equal to 3']),
));

test('With $type = "days"', catchAll(
    fn() => v::dateTimeDiff('days', v::equals(4))->assert('3 days ago'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The number of days between now and "3 days ago" must be equal to 4')
        ->and($fullMessage)->toBe('- The number of days between now and "3 days ago" must be equal to 4')
        ->and($messages)->toBe(['dateTimeDiffEquals' => 'The number of days between now and "3 days ago" must be equal to 4']),
));

test('With $type = "hours"', catchAll(
    fn() => v::dateTimeDiff('hours', v::equals(5))->assert('4 hours ago'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The number of hours between now and "4 hours ago" must be equal to 5')
        ->and($fullMessage)->toBe('- The number of hours between now and "4 hours ago" must be equal to 5')
        ->and($messages)->toBe(['dateTimeDiffEquals' => 'The number of hours between now and "4 hours ago" must be equal to 5']),
));

test('With $type = "minutes"', catchAll(
    fn() => v::dateTimeDiff('minutes', v::equals(6))->assert('5 minutes ago'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The number of minutes between now and "5 minutes ago" must be equal to 6')
        ->and($fullMessage)->toBe('- The number of minutes between now and "5 minutes ago" must be equal to 6')
        ->and($messages)->toBe(['dateTimeDiffEquals' => 'The number of minutes between now and "5 minutes ago" must be equal to 6']),
));

test('With $type = "microseconds"', catchAll(
    fn() => v::dateTimeDiff('microseconds', v::equals(7))->assert('6 microseconds ago'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The number of microseconds between now and "6 microseconds ago" must be equal to 7')
        ->and($fullMessage)->toBe('- The number of microseconds between now and "6 microseconds ago" must be equal to 7')
        ->and($messages)->toBe(['dateTimeDiffEquals' => 'The number of microseconds between now and "6 microseconds ago" must be equal to 7']),
));

test('With custom $format', catchAll(
    fn() => v::dateTimeDiff('years', v::lessThan(8), 'd/m/Y')->assert('09/12/1988'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toMatch('|The number of years between "\d+/\d+/\d+" and "09/12/1988" must be less than 8|')
        ->and($fullMessage)->toMatch('|- The number of years between "\d+/\d+/\d+" and "09/12/1988" must be less than 8|'),
));

test('With input in non-parseable date', catchAll(
    fn() => v::dateTimeDiff('years', v::equals(2))->assert('not a date'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('For comparison with now, "not a date" must be a valid datetime')
        ->and($fullMessage)->toBe('- For comparison with now, "not a date" must be a valid datetime')
        ->and($messages)->toBe(['dateTimeDiffEquals' => 'For comparison with now, "not a date" must be a valid datetime']),
));

test('With input in incorrect $format', catchAll(
    fn() => v::dateTimeDiff('years', v::equals(2), 'Y-m-d')->assert('1 year ago'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toMatch('/For comparison with \d+-\d+-\d+, "1 year ago" must be a valid datetime in the format \d+-\d+-\d+/')
        ->and($fullMessage)->toMatch('/- For comparison with \d+-\d+-\d+, "1 year ago" must be a valid datetime in the format \d+-\d+-\d+/'),
));

test('With custom $now', catchAll(
    fn() => v::dateTimeDiff('years', v::lessThan(9), null, new DateTimeImmutable())->assert('09/12/1988'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toMatch('/The number of years between "\d+-\d+-\d+ \d+:\d+:\d+.\d+" and "09\/12\/1988" must be less than 9/')
        ->and($fullMessage)->toMatch('/- The number of years between "\d+-\d+-\d+ \d+:\d+:\d+.\d+" and "09\/12\/1988" must be less than 9/'),
));

test('With custom template', catchAll(
    fn() => v::dateTimeDiff('years', v::templated(v::equals(2), 'Custom template'))->assert('1 year ago'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Custom template')
        ->and($fullMessage)->toBe('- Custom template')
        ->and($messages)->toBe(['equals' => 'Custom template']),
));

test('Wrapped by "not"', catchAll(
    fn() => v::not(v::dateTimeDiff('years', v::lessThan(8)))->assert('7 year ago'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The number of years between now and "7 year ago" must not be less than 8')
        ->and($fullMessage)->toBe('- The number of years between now and "7 year ago" must not be less than 8')
        ->and($messages)->toBe(['notDateTimeDiffLessThan' => 'The number of years between now and "7 year ago" must not be less than 8']),
));

test('Wrapping "not"', catchAll(
    fn() => v::dateTimeDiff('years', v::not(v::lessThan(9)))->assert('8 year ago'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The number of years between now and "8 year ago" must not be less than 9')
        ->and($fullMessage)->toBe('- The number of years between now and "8 year ago" must not be less than 9')
        ->and($messages)->toBe(['dateTimeDiffNotLessThan' => 'The number of years between now and "8 year ago" must not be less than 9']),
));

test('Wrapped with custom template', catchAll(
    fn() => v::dateTimeDiff('years', v::templated(v::equals(2), 'Wrapped with custom template'))->assert('1 year ago'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapped with custom template')
        ->and($fullMessage)->toBe('- Wrapped with custom template')
        ->and($messages)->toBe(['equals' => 'Wrapped with custom template']),
));

test('Wrapper with custom template', catchAll(
    fn() => v::templated(v::dateTimeDiff('years', v::equals(2)), 'Wrapper with custom template')->assert('1 year ago'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('Wrapper with custom template')
        ->and($fullMessage)->toBe('- Wrapper with custom template')
        ->and($messages)->toBe(['dateTimeDiffEquals' => 'Wrapper with custom template']),
));

test('Without adjacent result', catchAll(
    fn() => v::dateTimeDiff('years', v::primeNumber()->between(2, 5))->assert('1 year ago'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The number of years between now and "1 year ago" must be a prime number')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - "1 year ago" must pass all the rules
          - The number of years between now and "1 year ago" must be a prime number
          - The number of years between now and "1 year ago" must be between 2 and 5
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"1 year ago" must pass all the rules',
            'dateTimeDiffPrimeNumber' => 'The number of years between now and "1 year ago" must be a prime number',
            'dateTimeDiffBetween' => 'The number of years between now and "1 year ago" must be between 2 and 5',
        ]),
));

test('Without adjacent result with templates', catchAll(
    fn() => v::dateTimeDiff('years', v::primeNumber()->between(2, 5))->setTemplates([
        'dateTimeDiff' => [
            'primeNumber' => 'Interval must be a valid prime number',
            'between' => 'Interval must be between 2 and 5',
        ],
    ])->assert('1 year ago'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('The number of years between now and "1 year ago" must be a prime number')
        ->and($fullMessage)->toBe(<<<'FULL_MESSAGE'
        - "1 year ago" must pass all the rules
          - The number of years between now and "1 year ago" must be a prime number
          - The number of years between now and "1 year ago" must be between 2 and 5
        FULL_MESSAGE)
        ->and($messages)->toBe([
            '__root__' => '"1 year ago" must pass all the rules',
            'dateTimeDiffPrimeNumber' => 'The number of years between now and "1 year ago" must be a prime number',
            'dateTimeDiffBetween' => 'The number of years between now and "1 year ago" must be between 2 and 5',
        ]),
));
