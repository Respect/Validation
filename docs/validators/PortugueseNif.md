<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# PortugueseNif

- `PortugueseNif()`

Validates Portugal's fiscal identification number ([NIF](https://pt.wikipedia.org/wiki/N%C3%BAmero_de_identifica%C3%A7%C3%A3o_fiscal)).

```php
v::portugueseNif()->assert('124885446');
// Validation passes successfully

v::portugueseNif()->assert('220005245');
// → "220005245" must be a Portuguese NIF
```

## Templates

### `PortugueseNif::TEMPLATE_STANDARD`

|       Mode | Template                                 |
| ---------: | :--------------------------------------- |
|  `default` | {{subject}} must be a Portuguese NIF     |
| `inverted` | {{subject}} must not be a Portuguese NIF |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
| ------: | :---------- |
|   2.2.0 | Created     |

## See Also

- [Bsn](Bsn.md)
- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
- [Hetu](Hetu.md)
- [Nif](Nif.md)
