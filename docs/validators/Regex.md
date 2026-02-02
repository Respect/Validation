<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Regex

- `Regex(string $regex)`

Validates whether the input matches a defined regular expression.

```php
v::regex('/[a-z]/')->assert('a');
// Validation passes successfully
```

Message template for this validator includes `{{regex}}`.

## Templates

### `Regex::TEMPLATE_STANDARD`

|       Mode | Template                                                    |
| ---------: | :---------------------------------------------------------- |
|  `default` | {{subject}} must match the {{regex&#124;quote}} pattern     |
| `inverted` | {{subject}} must not match the {{regex&#124;quote}} pattern |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |
| `regex`     |                                                                  |

## Categorization

- Strings

## Changelog

| Version | Description       |
| ------: | :---------------- |
|   3.0.0 | Templates changed |
|   0.3.9 | Created           |

## See Also

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Contains](Contains.md)
- [CreditCard](CreditCard.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [EndsWith](EndsWith.md)
- [Roman](Roman.md)
- [StartsWith](StartsWith.md)
- [Version](Version.md)
