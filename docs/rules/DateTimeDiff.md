# DateTimeDiff

- `DateTimeDiff(Validatable $rule)`
- `DateTimeDiff(Validatable $rule, string $type)`
- `DateTimeDiff(Validatable $rule, string $type, string $format)`

Validates the difference of date/time against a specific rule.

The `$format` argument should follow PHP's [date()][] function. When the `$format` is not given, this rule accepts
[Supported Date and Time Formats][] by PHP (see [strtotime()][]).

The `$type` argument should follow PHP's [DateInterval] properties. When the `$type` is not given, its default value is `y`.

```php
v::dateTimeDiff(v::equal(7))->validate('7 years ago - 1 minute'); // true
v::dateTimeDiff(v::equal(7))->validate('7 years ago + 1 minute'); // false

v::dateTimeDiff(v::greaterThan(18), 'y', 'd/m/Y')->validate('09/12/1990'); // true
v::dateTimeDiff(v::greaterThan(18), 'y', 'd/m/Y')->validate('09/12/2023'); // false

v::dateTimeDiff(v::between(1, 18), 'm')->validate('5 months ago'); // true
```

The supported types are:

* `years` as `y`
* `months` as `m`
* `days` as `days` and `d`
* `hours` as `h`
* `minutes` as `i`
* `seconds` as `s`
* `microseconds` as `f`

Difference between `d` and `days`

`d` (days): Represents the difference in days within the same month or year. For example, if the difference between two dates is 1 month and 10 days, the value of d will be 10.

`days` (full days): Represents the total difference in days between two dates, regardless of months or years. For example, if the difference between two dates is 1 month and 10 days, the value of days will be the total number of days between these dates.

## Categorization

- Date and Time

## Changelog

| Version | Description                                |
| ------: |--------------------------------------------|
|   3.0.0 | Created from `Age`, `MinAge`, and `MaxAge` |

***
See also:

- [Date](Date.md)
- [DateTime](DateTime.md)
- [Max](Max.md)
- [Min](Min.md)
- [Time](Time.md)

[date()]: http://php.net/date
[DateTimeInterface]: http://php.net/DateTimeInterface
[strtotime()]: http://php.net/strtotime
[Supported Date and Time Formats]: http://php.net/datetime.formats
[DateInterval]: https://www.php.net/manual/en/class.dateinterval.php
