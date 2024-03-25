--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

date_default_timezone_set('UTC');

run([
    'Without customizations' => [v::dateTimeDiff(v::equals(2)), '1 year ago'],
    'With $type = "months"' => [v::dateTimeDiff(v::equals(3), 'months'), '2 months ago'],
    'With $type = "days"' => [v::dateTimeDiff(v::equals(4), 'days'), '3 days ago'],
    'With $type = "hours"' => [v::dateTimeDiff(v::equals(5), 'hours'), '4 hours ago'],
    'With $type = "minutes"' => [v::dateTimeDiff(v::equals(6), 'minutes'), '5 minutes ago'],
    'With $type = "microseconds"' => [v::dateTimeDiff(v::equals(7), 'microseconds'), '6 microseconds ago'],
    'With custom $format' => [v::dateTimeDiff(v::lessThan(8), 'years', 'd/m/Y'), '09/12/1988'],
    'With custom $now' => [v::dateTimeDiff(v::lessThan(9), 'years', null, new DateTimeImmutable()), '09/12/1988'],
    'Wrapped by "not"' => [v::not(v::dateTimeDiff(v::lessThan(8))), '7 year ago'],
    'Wrapping "not"' => [v::dateTimeDiff(v::not(v::lessThan(9))), '8 year ago'],
]);
?>
--EXPECTF--
Without customizations
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between now and 1 year ago must equal 2
- The number of years between now and 1 year ago must equal 2
[
    'dateTimeDiff' => 'The number of years between now and 1 year ago must equal 2',
]

With $type = "months"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of months between now and 2 months ago must equal 3
- The number of months between now and 2 months ago must equal 3
[
    'dateTimeDiff' => 'The number of months between now and 2 months ago must equal 3',
]

With $type = "days"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of days between now and 3 days ago must equal 4
- The number of days between now and 3 days ago must equal 4
[
    'dateTimeDiff' => 'The number of days between now and 3 days ago must equal 4',
]

With $type = "hours"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of hours between now and 4 hours ago must equal 5
- The number of hours between now and 4 hours ago must equal 5
[
    'dateTimeDiff' => 'The number of hours between now and 4 hours ago must equal 5',
]

With $type = "minutes"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of minutes between now and 5 minutes ago must equal 6
- The number of minutes between now and 5 minutes ago must equal 6
[
    'dateTimeDiff' => 'The number of minutes between now and 5 minutes ago must equal 6',
]

With $type = "microseconds"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of microseconds between now and 6 microseconds ago must equal 7
- The number of microseconds between now and 6 microseconds ago must equal 7
[
    'dateTimeDiff' => 'The number of microseconds between now and 6 microseconds ago must equal 7',
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
    'dateTimeDiff' => 'The number of years between now and 7 year ago must not be less than 8',
]

Wrapping "not"
⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
The number of years between now and 8 year ago must not be less than 9
- The number of years between now and 8 year ago must not be less than 9
[
    'dateTimeDiff' => 'The number of years between now and 8 year ago must not be less than 9',
]

