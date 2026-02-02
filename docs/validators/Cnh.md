<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Cnh

- `Cnh()`

Validates a Brazilian driver's license.

```php
v::cnh()->assert('02650306461');
// Validation passes successfully
```

## Templates

### `Cnh::TEMPLATE_STANDARD`

|       Mode | Template                      |
| ---------: | :---------------------------- |
|  `default` | {{subject}} must be a CNH     |
| `inverted` | {{subject}} must not be a CNH |

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
|   0.5.0 | Created           |

## See Also

- [Bsn](Bsn.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
- [Hetu](Hetu.md)
- [Imei](Imei.md)
- [NfeAccessKey](NfeAccessKey.md)
- [Nif](Nif.md)
- [Pis](Pis.md)
- [PortugueseNif](PortugueseNif.md)
