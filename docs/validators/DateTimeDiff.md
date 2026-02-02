<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# DateTimeDiff

- `DateTimeDiff("years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type, Validator $validator)`
- `DateTimeDiff("years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type, Validator $validator, string $format)`
- `DateTimeDiff("years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type, Validator $validator, string $format, DateTimeImmutable $now)`

Validates the difference of date/time against a specific validator.

The `$format` argument should follow PHP's [date()][] function. When the `$format` is not given, this validator accepts
[Supported Date and Time Formats][] by PHP (see [strtotime()][]).

```php
v::dateTimeDiff('years', v::greaterThan(18), 'd/m/Y')->assert('09/12/1990');
// Validation passes successfully

v::dateTimeDiff('years', v::equals(7))->assert('7 years ago');
// → The number of years between now and "7 years ago" must be equal to 7

v::dateTimeDiff('years', v::equals(7))->assert('7 years ago + 1 minute');
// → The number of years between now and "7 years ago + 1 minute" must be equal to 7

v::dateTimeDiff('years', v::greaterThan(18), 'd/m/Y')->assert('09/12/2023');
// → The number of years between "01/01/2024" and "09/12/2023" must be greater than 18

v::dateTimeDiff('months', v::between(1, 18))->assert('5 months ago');
// Validation passes successfully
```

The supported types are:

- `years`
- `months`
- `days`
- `hours`
- `minutes`
- `seconds`
- `microseconds`

## Templates

### `DateTimeDiff::TEMPLATE_STANDARD`

Used when `$format` and `$now` are not defined.

|       Mode | Template                                          |
| ---------: | :------------------------------------------------ |
|  `default` | The number of {{type&#124;trans}} between now and |
| `inverted` | The number of {{type&#124;trans}} between now and |

### `DateTimeDiff::TEMPLATE_CUSTOMIZED`

Used when `$format` or `$now` are defined.

|       Mode | Template                                              |
| ---------: | :---------------------------------------------------- |
|  `default` | The number of {{type&#124;trans}} between {{now}} and |
| `inverted` | The number of {{type&#124;trans}} between {{now}} and |

### `DateTimeDiff::TEMPLATE_NOT_A_DATE`

|       Mode | Template                                                                 |
| ---------: | :----------------------------------------------------------------------- |
|  `default` | For comparison with {{now&#124;raw}}, {{subject}} must be a datetime     |
| `inverted` | For comparison with {{now&#124;raw}}, {{subject}} must not be a datetime |

### `DateTimeDiff::TEMPLATE_WRONG_FORMAT`

Used when the input cannot be parsed with the given format.

|       Mode | Template                                                                                                   |
| ---------: | :--------------------------------------------------------------------------------------------------------- |
|  `default` | For comparison with {{now&#124;raw}}, {{subject}} must be a datetime in the format {{sample&#124;raw}}     |
| `inverted` | For comparison with {{now&#124;raw}}, {{subject}} must not be a datetime in the format {{sample&#124;raw}} |

## Template as prefix

The template serves as a prefix to the template of the inner validator.

```php
v::dateTimeDiff('years', v::equals(2))->assert('1 year ago');
// → The number of years between now and "1 year ago" must be equal to 2

v::not(v::dateTimeDiff('years', v::lessThan(8)))->assert('7 year ago');
// → The number of years between now and "7 year ago" must not be less than 8
```

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |
| `now`       | The date and time that is considered as now.                     |
| `sample`    | A sample of the datetime.                                        |
| `type`      | The type of interval (years, months, etc.).                      |

## Caveats

When using custom templates, the key must be `dateTimeDiff` + name of the validator you passed, for example:

```php
v::dateTimeDiff('years', v::equals(2))->assert('1 year ago', [
    'dateTimeDiffEquals' => 'Please enter a date that is 2 years ago'
]);
// → Please enter a date that is 2 years ago
```

## Categorization

- Date and Time

## Changelog

| Version | Description                                |
| ------: | :----------------------------------------- |
|   3.0.0 | Created from `Age`, `MinAge`, and `MaxAge` |

## See Also

- [Date](Date.md)
- [DateTime](DateTime.md)
- [Max](Max.md)
- [Min](Min.md)
- [Time](Time.md)

[date()]: http://php.net/date
[DateTimeInterface]: http://php.net/DateTimeInterface
[strtotime()]: http://php.net/strtotime
[Supported Date and Time Formats]: http://php.net/datetime.formats
