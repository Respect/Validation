<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Luhn

- `Luhn()`

Validate whether a given input is a [Luhn][] number.

```php
v::luhn()->assert('2222400041240011');
// Validation passes successfully

v::luhn()->assert('respect!');
// → "respect!" must be a Luhn number
```

## Templates

### `Luhn::TEMPLATE_STANDARD`

|       Mode | Template                              |
| ---------: | :------------------------------------ |
|  `default` | {{subject}} must be a Luhn number     |
| `inverted` | {{subject}} must not be a Luhn number |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description       |
| ------: | :---------------- |
|   3.0.0 | Templates changed |
|   2.0.0 | Created           |

## See Also

- [CreditCard](CreditCard.md)
- [Imei](Imei.md)
- [Isbn](Isbn.md)

[Luhn]: https://en.wikipedia.org/wiki/Luhn_algorithm
