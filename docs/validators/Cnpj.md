<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Cnpj

- `Cnpj()`

Validates if the input is a Brazilian National Registry of Legal Entities (CNPJ) number.
Ignores non-digit chars, so use `->digit()` if needed.

```php
v::cnpj()->assert('00394460005887');
// Validation passes successfully
```

## Templates

### `Cnpj::TEMPLATE_STANDARD`

|       Mode | Template                                    |
| ---------: | :------------------------------------------ |
|  `default` | {{subject}} must be a valid CNPJ number     |
| `inverted` | {{subject}} must not be a valid CNPJ number |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
| ------: | :---------- |
|   0.3.9 | Created     |

## See Also

- [Bsn](Bsn.md)
- [Cnh](Cnh.md)
- [Cpf](Cpf.md)
- [Hetu](Hetu.md)
- [Imei](Imei.md)
- [NfeAccessKey](NfeAccessKey.md)
- [Nif](Nif.md)
- [Pis](Pis.md)
- [PortugueseNif](PortugueseNif.md)
