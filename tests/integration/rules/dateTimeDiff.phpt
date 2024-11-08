--FILE--
<?php

require 'vendor/autoload.php';

date_default_timezone_set('UTC');

run([
    'With $type = "years"' => [v::dateTimeDiff('years', v::equals(2)), '1 year ago'],
    'With $type = "months"' => [v::dateTimeDiff('months', v::equals(3)), '2 months ago'],
    'With $type = "days"' => [v::dateTimeDiff('days', v::equals(4)), '3 days ago'],
    'With $type = "hours"' => [v::dateTimeDiff('hours', v::equals(5)), '4 hours ago'],
    'With $type = "minutes"' => [v::dateTimeDiff('minutes', v::equals(6)), '5 minutes ago'],
    'With $type = "microseconds"' => [v::dateTimeDiff('microseconds', v::equals(7)), '6 microseconds ago'],
    'With custom $format' => [v::dateTimeDiff('years', v::lessThan(8), 'd/m/Y'), '09/12/1988'],
    'With input in incorrect $format' => [v::dateTimeDiff('years', v::equals(2), 'Y-m-d'), '1 year ago'],
    'With custom $now' => [v::dateTimeDiff('years', v::lessThan(9), null, new DateTimeImmutable()), '09/12/1988'],
    'With custom template' => [v::dateTimeDiff('years', v::equals(2)->setTemplate('Custom template')), '1 year ago'],
    'Wrapped by "not"' => [v::not(v::dateTimeDiff('years', v::lessThan(8))), '7 year ago'],
    'Wrapping "not"' => [v::dateTimeDiff('years', v::not(v::lessThan(9))), '8 year ago'],
    'Wrapped with custom template' => [
        v::dateTimeDiff('years', v::equals(2)->setTemplate('Wrapped with custom template')),
        '1 year ago',
    ],
    'Wrapper with custom template' => [
        v::dateTimeDiff('years', v::equals(2))->setTemplate('Wrapper with custom template'),
        '1 year ago',
    ],
    'Not a sibling compatible' => [
        v::dateTimeDiff('years', v::primeNumber()->between(2, 5)),
        '1 year ago',
    ],
    'Not a sibling compatible with templates' => [
        v::dateTimeDiff('years', v::primeNumber()->between(2, 5)),
        '1 year ago',
        [
            'dateTimeDiff' => [
                'primeNumber' => 'Interval must be a valid prime number',
                'between' => 'Interval must be between 2 and 5',
            ],
        ],
    ],
]);
?>
--EXPECTF--
With $type = "years"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between now and 1 year ago must be equal to 2
- The number of years between now and 1 year ago must be equal to 2
[
    'dateTimeDiffEquals' => 'The number of years between now and 1 year ago must be equal to 2',
]

With $type = "months"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of months between now and 2 months ago must be equal to 3
- The number of months between now and 2 months ago must be equal to 3
[
    'dateTimeDiffEquals' => 'The number of months between now and 2 months ago must be equal to 3',
]

With $type = "days"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of days between now and 3 days ago must be equal to 4
- The number of days between now and 3 days ago must be equal to 4
[
    'dateTimeDiffEquals' => 'The number of days between now and 3 days ago must be equal to 4',
]

With $type = "hours"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of hours between now and 4 hours ago must be equal to 5
- The number of hours between now and 4 hours ago must be equal to 5
[
    'dateTimeDiffEquals' => 'The number of hours between now and 4 hours ago must be equal to 5',
]

With $type = "minutes"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of minutes between now and 5 minutes ago must be equal to 6
- The number of minutes between now and 5 minutes ago must be equal to 6
[
    'dateTimeDiffEquals' => 'The number of minutes between now and 5 minutes ago must be equal to 6',
]

With $type = "microseconds"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of microseconds between now and 6 microseconds ago must be equal to 7
- The number of microseconds between now and 6 microseconds ago must be equal to 7
[
    'dateTimeDiffEquals' => 'The number of microseconds between now and 6 microseconds ago must be equal to 7',
]

With custom $format
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between %d/%d/%d and 09/12/1988 must be less than 8
- The number of years between %d/%d/%d and 09/12/1988 must be less than 8
[
    'dateTimeDiffLessThan' => 'The number of years between %d/%d/%d and 09/12/1988 must be less than 8',
]

With input in incorrect $format
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
For comparison with %d-%d-%d, "1 year ago" must be a valid datetime in the format 2024-12-09
- For comparison with %d-%d-%d, "1 year ago" must be a valid datetime in the format 2024-12-09
[
    'dateTimeDiffEquals' => 'For comparison with %d-%d-%d, "1 year ago" must be a valid datetime in the format 2024-12-09',
]

With custom $now
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between %d-%d-%d %d:%d:%d.%d and 09/12/1988 must be less than 9
- The number of years between %d-%d-%d %d:%d:%d.%d and 09/12/1988 must be less than 9
[
    'dateTimeDiffLessThan' => 'The number of years between %d-%d-%d %d:%d:%d.%d and 09/12/1988 must be less than 9',
]

With custom template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Custom template
- Custom template
[
    'equals' => 'Custom template',
]

Wrapped by "not"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between now and 7 year ago must not be less than 8
- The number of years between now and 7 year ago must not be less than 8
[
    'notDateTimeDiffLessThan' => 'The number of years between now and 7 year ago must not be less than 8',
]

Wrapping "not"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between now and 8 year ago must not be less than 9
- The number of years between now and 8 year ago must not be less than 9
[
    'dateTimeDiffNotLessThan' => 'The number of years between now and 8 year ago must not be less than 9',
]

Wrapped with custom template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapped with custom template
- Wrapped with custom template
[
    'equals' => 'Wrapped with custom template',
]

Wrapper with custom template
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
Wrapper with custom template
- Wrapper with custom template
[
    'dateTimeDiffEquals' => 'Wrapper with custom template',
]

Not a sibling compatible
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between now and 1 year ago must be a prime number
- All of the required rules must pass for 1 year ago
  - The number of years between now and 1 year ago must be a prime number
  - The number of years between now and 1 year ago must be between 2 and 5
[
    '__root__' => 'All of the required rules must pass for 1 year ago',
    'dateTimeDiffPrimeNumber' => 'The number of years between now and 1 year ago must be a prime number',
    'dateTimeDiffBetween' => 'The number of years between now and 1 year ago must be between 2 and 5',
]

Not a sibling compatible with templates
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between now and 1 year ago must be a prime number
- All of the required rules must pass for 1 year ago
  - The number of years between now and 1 year ago must be a prime number
  - The number of years between now and 1 year ago must be between 2 and 5
[
    '__root__' => 'All of the required rules must pass for 1 year ago',
    'dateTimeDiffPrimeNumber' => 'The number of years between now and 1 year ago must be a prime number',
    'dateTimeDiffBetween' => 'The number of years between now and 1 year ago must be between 2 and 5',
]
