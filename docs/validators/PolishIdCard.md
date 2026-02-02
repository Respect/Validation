<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# PolishIdCard

- `PolishIdCard()`

Validates whether the input is a Polish identity card (Dowód Osobisty).

```php
v::polishIdCard()->assert('AYW036733');
// Validation passes successfully

v::polishIdCard()->assert('APH505567');
// Validation passes successfully

v::polishIdCard()->assert('APH 505567');
// → "APH 505567" must be a Polish Identity Card number

v::polishIdCard()->assert('AYW036731');
// → "AYW036731" must be a Polish Identity Card number
```

## Templates

### `PolishIdCard::TEMPLATE_STANDARD`

|       Mode | Template                                              |
| ---------: | :---------------------------------------------------- |
|  `default` | {{subject}} must be a Polish Identity Card number     |
| `inverted` | {{subject}} must not be a Polish Identity Card number |

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

- [Nip](Nip.md)
- [Pesel](Pesel.md)
- [SubdivisionCode](SubdivisionCode.md)
