<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
SPDX-FileContributor: Ronald Drenth <ronalddrenth@gmail.com>
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

|       Mode | Template                            |
| ---------: | :---------------------------------- |
|  `default` | {{subject}} must be a valid BSN     |
| `inverted` | {{subject}} must not be a valid BSN |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
| ------: | :---------- |
|   1.0.0 | Created     |

## See Also

- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
- [Imei](Imei.md)
- [Nif](Nif.md)
- [PortugueseNif](PortugueseNif.md)
