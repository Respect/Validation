<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Time

- `Time()`
- `Time(string $format)`

Validates whether an input is a time or not. The `$format` argument should be in
accordance to PHP's [date()](http://php.net/date) function, but only those are
allowed:

| Format | Description                                     | Values                |
| ------ | ----------------------------------------------- | --------------------- |
| `g`    | 12-hour format of an hour without leading zeros | 1 through 12          |
| `G`    | 24-hour format of an hour without leading zeros | 0 through 23          |
| `h`    | 12-hour format of an hour with leading zeros    | 01 through 12         |
| `H`    | 24-hour format of an hour with leading zeros    | 00 through 23         |
| `i`    | Minutes with leading zeros                      | 00 to 59              |
| `s`    | Seconds, with leading zeros                     | 00 through 59         |
| `u`    | Microseconds                                    | 000000 through 999999 |
| `v`    | Milliseconds                                    | 000 through 999       |
| `a`    | Lowercase Ante meridiem and Post meridiem       | am or pm              |
| `A`    | Uppercase Ante meridiem and Post meridiem       | AM or PM              |

When a `$format` is not given its default value is `H:i:s`.

```php
v::time()->assert('00:00:00');
// Validation passes successfully

v::time()->assert('23:20:59');
// Validation passes successfully

v::time('H:i')->assert('23:59');
// Validation passes successfully

v::time('g:i A')->assert('8:13 AM');
// Validation passes successfully

v::time('His')->assert(232059);
// Validation passes successfully

v::time()->assert('24:00:00');
// → "24:00:00" must be a valid time in the format "23:59:59"

v::time()->assert(new DateTime());
// → `DateTime { 2024-01-01T12:00:00+00:00 }` must be a valid time in the format "23:59:59"

v::time()->assert(new DateTimeImmutable());
// → `DateTimeImmutable { 2024-01-01T12:00:00+00:00 }` must be a valid time in the format "23:59:59"
```

## Templates

### `Time::TEMPLATE_STANDARD`

|       Mode | Template                                                      |
| ---------: | :------------------------------------------------------------ |
|  `default` | {{subject}} must be a valid time in the format {{sample}}     |
| `inverted` | {{subject}} must not be a valid time in the format {{sample}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |
| `sample`    |                                                                  |

## Categorization

- Date and Time

## Changelog

| Version | Description |
| ------: | :---------- |
|   2.0.0 | Created     |

## See Also

- [Date](Date.md)
- [DateTime](DateTime.md)
- [DateTimeDiff](DateTimeDiff.md)
- [LeapDate](LeapDate.md)
- [LeapYear](LeapYear.md)
