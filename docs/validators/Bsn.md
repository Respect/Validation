<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Bsn

- `Bsn()`

Validates a Dutch citizen service number ([BSN](https://nl.wikipedia.org/wiki/Burgerservicenummer)).

```php
v::bsn()->assert('612890053');
// Validation passes successfully
```

## Templates

### `Bsn::TEMPLATE_STANDARD`

|       Mode | Template                      |
| ---------: | :---------------------------- |
|  `default` | {{subject}} must be a BSN     |
| `inverted` | {{subject}} must not be a BSN |

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
|   1.0.0 | Created           |

## See Also

- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
- [Imei](Imei.md)
- [Nif](Nif.md)
- [PortugueseNif](PortugueseNif.md)
