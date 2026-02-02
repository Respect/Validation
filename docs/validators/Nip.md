<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Nip

- `Nip()`

Validates whether the input is a Polish VAT identification number (NIP).

```php
v::nip()->assert('1645865777');
// Validation passes successfully

v::nip()->assert('1645865778');
// → "1645865778" must be a Polish VAT identification number

v::nip()->assert('1234567890');
// → "1234567890" must be a Polish VAT identification number

v::nip()->assert('164-586-57-77');
// → "164-586-57-77" must be a Polish VAT identification number

v::nip()->assert('164-58-65-777');
// → "164-58-65-777" must be a Polish VAT identification number
```

## Templates

### `Nip::TEMPLATE_STANDARD`

|       Mode | Template                                                   |
| ---------: | :--------------------------------------------------------- |
|  `default` | {{subject}} must be a Polish VAT identification number     |
| `inverted` | {{subject}} must not be a Polish VAT identification number |

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

- [Pesel](Pesel.md)
- [PolishIdCard](PolishIdCard.md)
- [SubdivisionCode](SubdivisionCode.md)
