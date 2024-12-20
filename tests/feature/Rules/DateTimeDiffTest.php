<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('With $type = "years"', expectAll(
    fn() => v::dateTimeDiff('years', v::equals(2))->assert('1 year ago'),
    'The number of years between now and "1 year ago" must be equal to 2',
    '- The number of years between now and "1 year ago" must be equal to 2',
    ['dateTimeDiffEquals' => 'The number of years between now and "1 year ago" must be equal to 2']
));

test('With $type = "months"', expectAll(
    fn() => v::dateTimeDiff('months', v::equals(3))->assert('2 months ago'),
    'The number of months between now and "2 months ago" must be equal to 3',
    '- The number of months between now and "2 months ago" must be equal to 3',
    ['dateTimeDiffEquals' => 'The number of months between now and "2 months ago" must be equal to 3']
));

test('With $type = "days"', expectAll(
    fn() => v::dateTimeDiff('days', v::equals(4))->assert('3 days ago'),
    'The number of days between now and "3 days ago" must be equal to 4',
    '- The number of days between now and "3 days ago" must be equal to 4',
    ['dateTimeDiffEquals' => 'The number of days between now and "3 days ago" must be equal to 4']
));

test('With $type = "hours"', expectAll(
    fn() => v::dateTimeDiff('hours', v::equals(5))->assert('4 hours ago'),
    'The number of hours between now and "4 hours ago" must be equal to 5',
    '- The number of hours between now and "4 hours ago" must be equal to 5',
    ['dateTimeDiffEquals' => 'The number of hours between now and "4 hours ago" must be equal to 5']
));

test('With $type = "minutes"', expectAll(
    fn() => v::dateTimeDiff('minutes', v::equals(6))->assert('5 minutes ago'),
    'The number of minutes between now and "5 minutes ago" must be equal to 6',
    '- The number of minutes between now and "5 minutes ago" must be equal to 6',
    ['dateTimeDiffEquals' => 'The number of minutes between now and "5 minutes ago" must be equal to 6']
));

test('With $type = "microseconds"', expectAll(
    fn() => v::dateTimeDiff('microseconds', v::equals(7))->assert('6 microseconds ago'),
    'The number of microseconds between now and "6 microseconds ago" must be equal to 7',
    '- The number of microseconds between now and "6 microseconds ago" must be equal to 7',
    ['dateTimeDiffEquals' => 'The number of microseconds between now and "6 microseconds ago" must be equal to 7']
));

test('With custom $format', expectAllToMatch(
    fn() => v::dateTimeDiff('years', v::lessThan(8), 'd/m/Y')->assert('09/12/1988'),
    'The number of years between "%d/%d/%d" and "09/12/1988" must be less than 8',
    '- The number of years between "%d/%d/%d" and "09/12/1988" must be less than 8',
    ['dateTimeDiffLessThan' => 'The number of years between "%d/%d/%d" and "09/12/1988" must be less than 8']
));

test('With input in non-parseable date', expectAll(
    fn() => v::dateTimeDiff('years', v::equals(2))->assert('not a date'),
    'For comparison with now, "not a date" must be a valid datetime',
    '- For comparison with now, "not a date" must be a valid datetime',
    ['dateTimeDiffEquals' => 'For comparison with now, "not a date" must be a valid datetime']
));

test('With input in incorrect $format', expectAllToMatch(
    fn() => v::dateTimeDiff('years', v::equals(2), 'Y-m-d')->assert('1 year ago'),
    'For comparison with %d-%d-%d, "1 year ago" must be a valid datetime in the format %d-%d-%d',
    '- For comparison with %d-%d-%d, "1 year ago" must be a valid datetime in the format %d-%d-%d',
    ['dateTimeDiffEquals' => 'For comparison with %d-%d-%d, "1 year ago" must be a valid datetime in the format %d-%d-%d']
));

test('With custom $now', expectAllToMatch(
    fn() => v::dateTimeDiff('years', v::lessThan(9), null, new DateTimeImmutable())->assert('09/12/1988'),
    'The number of years between "%d-%d-%d %d:%d:%d.%d" and "09/12/1988" must be less than 9',
    '- The number of years between "%d-%d-%d %d:%d:%d.%d" and "09/12/1988" must be less than 9',
    ['dateTimeDiffLessThan' => 'The number of years between "%d-%d-%d %d:%d:%d.%d" and "09/12/1988" must be less than 9']
));

test('With custom template', expectAll(
    fn() => v::dateTimeDiff('years', v::equals(2)->setTemplate('Custom template'))->assert('1 year ago'),
    'Custom template',
    '- Custom template',
    ['equals' => 'Custom template']
));

test('Wrapped by "not"', expectAll(
    fn() => v::not(v::dateTimeDiff('years', v::lessThan(8)))->assert('7 year ago'),
    'The number of years between now and "7 year ago" must not be less than 8',
    '- The number of years between now and "7 year ago" must not be less than 8',
    ['notDateTimeDiffLessThan' => 'The number of years between now and "7 year ago" must not be less than 8']
));

test('Wrapping "not"', expectAll(
    fn() => v::dateTimeDiff('years', v::not(v::lessThan(9)))->assert('8 year ago'),
    'The number of years between now and "8 year ago" must not be less than 9',
    '- The number of years between now and "8 year ago" must not be less than 9',
    ['dateTimeDiffNotLessThan' => 'The number of years between now and "8 year ago" must not be less than 9']
));

test('Wrapped with custom template', expectAll(
    fn() => v::dateTimeDiff('years', v::equals(2)->setTemplate('Wrapped with custom template'))->assert('1 year ago'),
    'Wrapped with custom template',
    '- Wrapped with custom template',
    ['equals' => 'Wrapped with custom template']
));

test('Wrapper with custom template', expectAll(
    fn() => v::dateTimeDiff('years', v::equals(2))->setTemplate('Wrapper with custom template')->assert('1 year ago'),
    'Wrapper with custom template',
    '- Wrapper with custom template',
    ['dateTimeDiffEquals' => 'Wrapper with custom template']
));

test('Without adjacent result', expectAll(
    fn() => v::dateTimeDiff('years', v::primeNumber()->between(2, 5))->assert('1 year ago'),
    'The number of years between now and "1 year ago" must be a prime number',
    <<<'FULL_MESSAGE'
    - All the required rules must pass for "1 year ago"
      - The number of years between now and "1 year ago" must be a prime number
      - The number of years between now and "1 year ago" must be between 2 and 5
    FULL_MESSAGE,
    [
        '__root__' => 'All the required rules must pass for "1 year ago"',
        'dateTimeDiffPrimeNumber' => 'The number of years between now and "1 year ago" must be a prime number',
        'dateTimeDiffBetween' => 'The number of years between now and "1 year ago" must be between 2 and 5',
    ]
));

test('Without adjacent result with templates', expectAll(
    fn() => v::dateTimeDiff('years', v::primeNumber()->between(2, 5))->setTemplates([
        'dateTimeDiff' => [
            'primeNumber' => 'Interval must be a valid prime number',
            'between' => 'Interval must be between 2 and 5',
        ],
    ])->assert('1 year ago'),
    'The number of years between now and "1 year ago" must be a prime number',
    <<<'FULL_MESSAGE'
    - All the required rules must pass for "1 year ago"
      - The number of years between now and "1 year ago" must be a prime number
      - The number of years between now and "1 year ago" must be between 2 and 5
    FULL_MESSAGE,
    [
        '__root__' => 'All the required rules must pass for "1 year ago"',
        'dateTimeDiffPrimeNumber' => 'The number of years between now and "1 year ago" must be a prime number',
        'dateTimeDiffBetween' => 'The number of years between now and "1 year ago" must be between 2 and 5',
    ]
));
