<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Date

- `Date()`
- `Date(string $format)`

Validates if input is a date. The `$format` argument should be in accordance to
PHP's [date()](http://php.net/date) function, but only those are allowed:

| Format | Description                                                        | Values                 |
| ------ | ------------------------------------------------------------------ | ---------------------- |
| `d`    | Day of the month, 2 digits with leading zeros                      | 01 to 31               |
| `j`    | Day of the month without leading zeros                             | 1 to 31                |
| `S`    | English ordinal suffix for the day of the month, 2 characters      | st, nd, rd or th       |
| `F`    | A full textual representation of a month, such as January or March | January to December    |
| `m`    | Numeric representation of a month, with leading zeros              | 01 to 12               |
| `M`    | A short textual representation of a month, three letters           | Jan to Dec             |
| `n`    | Numeric representation of a month, without leading zeros           | 1 to 12                |
| `Y`    | A full numeric representation of a year, 4 digits                  | Examples: 1988 or 2017 |
| `y`    | A two digit representation of a year                               | Examples: 88 or 17     |

When a `$format` is not given its default value is `Y-m-d`.

```php
v::date()->assert('2017-12-31');
// Validation passes successfully

v::date()->assert('2020-02-29');
// Validation passes successfully

v::date()->assert('2019-02-29');
// → "2019-02-29" must be a valid date in the format "2005-12-30"

v::date('m/d/y')->assert('12/31/17');
// Validation passes successfully

v::date('F jS, Y')->assert('May 1st, 2017');
// Validation passes successfully

v::date('Ydm')->assert(20173112);
// Validation passes successfully
```

## Templates

### `Date::TEMPLATE_STANDARD`

|       Mode | Template                                                      |
| ---------: | :------------------------------------------------------------ |
|  `default` | {{subject}} must be a valid date in the format {{sample}}     |
| `inverted` | {{subject}} must not be a valid date in the format {{sample}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |
| `sample`    |                                                                  |

## Categorization

- Date and Time

## Changelog

| Version | Description                    |
| ------: | :----------------------------- |
|   2.0.0 | Changed to only validate dates |
|   0.3.9 | Created as `Date`              |

## See Also

- [DateTime](DateTime.md)
- [DateTimeDiff](DateTimeDiff.md)
- [LeapDate](LeapDate.md)
- [LeapYear](LeapYear.md)
- [Time](Time.md)
