# DateTimeDiff

- `DateTimeDiff(string $type, Rule $rule)`
- `DateTimeDiff(string $type, Rule $rule, string $format)`

Validates the difference of date/time against a specific rule.

The `$format` argument should follow PHP's [date()][] function. When the `$format` is not given, this rule accepts
[Supported Date and Time Formats][] by PHP (see [strtotime()][]).

```php
v::dateTimeDiff('years', v::equals(7))->isValid('7 years ago'); // true
v::dateTimeDiff('years', v::equals(7))->isValid('7 years ago + 1 minute'); // false

v::dateTimeDiff('years', v::greaterThan(18), 'd/m/Y')->isValid('09/12/1990'); // true
v::dateTimeDiff('years', v::greaterThan(18), 'd/m/Y')->isValid('09/12/2023'); // false

v::dateTimeDiff('months', v::between(1, 18))->isValid('5 months ago'); // true
```

The supported types are:

* `years`
* `months`
* `days`
* `hours`
* `minutes`
* `seconds`
* `microseconds`

## Templates

`DateTimeDiff::TEMPLATE_STANDARD`

| Mode       | Template                                                     |
|------------|--------------------------------------------------------------|
| `default`  | The number of {{type&#124;raw}} between {{now&#124;raw}} and |
| `inverted` | The number of {{type&#124;raw}} between {{now&#124;raw}} and |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |
| `now`       |                                                                  |
| `type`      |                                                                  |

## Categorization

- Date and Time

## Changelog

| Version | Description                                |
|--------:|--------------------------------------------|
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
