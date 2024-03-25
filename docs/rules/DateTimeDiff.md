# DateTimeDiff

- `DateTimeDiff(string $type, Validatable $rule)`
- `DateTimeDiff(string $type, Validatable $rule, string $format)`

Validates the difference of date/time against a specific rule.

The `$format` argument should follow PHP's [date()][] function. When the `$format` is not given, this rule accepts
[Supported Date and Time Formats][] by PHP (see [strtotime()][]).

```php
v::dateTimeDiff('years', v::equals(7))->validate('7 years ago'); // true
v::dateTimeDiff('years', v::equals(7))->validate('7 years ago + 1 minute'); // false

v::dateTimeDiff('years', v::greaterThan(18), 'd/m/Y')->validate('09/12/1990'); // true
v::dateTimeDiff('years', v::greaterThan(18), 'd/m/Y')->validate('09/12/2023'); // false

v::dateTimeDiff('months', v::between(1, 18))->validate('5 months ago'); // true
```

The supported types are:

* `years`
* `months`
* `days`
* `hours`
* `minutes`
* `seconds`
* `microseconds`

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
