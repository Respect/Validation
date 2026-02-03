<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# LeapYear

- `LeapYear()`

Validates if a year is leap.

```php
v::leapYear()->assert('1988');
// Validation passes successfully
```

This validator accepts DateTime instances as well.

## Templates

### `LeapYear::TEMPLATE_STANDARD`

|       Mode | Template                              |
| ---------: | :------------------------------------ |
|  `default` | {{subject}} must be a valid leap year |
| `inverted` | {{subject}} must not be a leap year   |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Date and Time

## Changelog

| Version | Description |
| ------: | :---------- |
|   0.3.9 | Created     |

## See Also

- [Date](Date.md)
- [DateTime](DateTime.md)
- [LeapDate](LeapDate.md)
- [Time](Time.md)
