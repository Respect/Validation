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
    'With custom $now' => [v::dateTimeDiff('years', v::lessThan(9), null, new DateTimeImmutable()), '09/12/1988'],
    'Wrapped by "not"' => [v::not(v::dateTimeDiff('years', v::lessThan(8))), '7 year ago'],
    'Wrapping "not"' => [v::dateTimeDiff('years', v::not(v::lessThan(9))), '8 year ago'],
]);
?>
--EXPECTF--
With $type = "years"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between now and 1 year ago must be equal to 2
- The number of years between now and 1 year ago must be equal to 2
[
    'dateTimeDiff' => 'The number of years between now and 1 year ago must be equal to 2',
]

With $type = "months"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of months between now and 2 months ago must be equal to 3
- The number of months between now and 2 months ago must be equal to 3
[
    'dateTimeDiff' => 'The number of months between now and 2 months ago must be equal to 3',
]

With $type = "days"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of days between now and 3 days ago must be equal to 4
- The number of days between now and 3 days ago must be equal to 4
[
    'dateTimeDiff' => 'The number of days between now and 3 days ago must be equal to 4',
]

With $type = "hours"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of hours between now and 4 hours ago must be equal to 5
- The number of hours between now and 4 hours ago must be equal to 5
[
    'dateTimeDiff' => 'The number of hours between now and 4 hours ago must be equal to 5',
]

With $type = "minutes"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of minutes between now and 5 minutes ago must be equal to 6
- The number of minutes between now and 5 minutes ago must be equal to 6
[
    'dateTimeDiff' => 'The number of minutes between now and 5 minutes ago must be equal to 6',
]

With $type = "microseconds"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of microseconds between now and 6 microseconds ago must be equal to 7
- The number of microseconds between now and 6 microseconds ago must be equal to 7
[
    'dateTimeDiff' => 'The number of microseconds between now and 6 microseconds ago must be equal to 7',
]

With custom $format
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between %d/%d/%d and 09/12/1988 must be less than 8
- The number of years between %d/%d/%d and 09/12/1988 must be less than 8
[
    'dateTimeDiff' => 'The number of years between %d/%d/%d and 09/12/1988 must be less than 8',
]

With custom $now
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between %d-%d-%d %d:%d:%d.%d and 09/12/1988 must be less than 9
- The number of years between %d-%d-%d %d:%d:%d.%d and 09/12/1988 must be less than 9
[
    'dateTimeDiff' => 'The number of years between %d-%d-%d %d:%d:%d.%d and 09/12/1988 must be less than 9',
]

Wrapped by "not"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between now and 7 year ago must not be less than 8
- The number of years between now and 7 year ago must not be less than 8
[
    'notDateTimeDiff' => 'The number of years between now and 7 year ago must not be less than 8',
]

Wrapping "not"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between now and 8 year ago must not be less than 9
- The number of years between now and 8 year ago must not be less than 9
[
    'dateTimeDiff' => 'The number of years between now and 8 year ago must not be less than 9',
]
