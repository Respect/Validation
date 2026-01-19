<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Nif

- `Nif()`

Validates Spain's fiscal identification number ([NIF](https://es.wikipedia.org/wiki/N%C3%BAmero_de_identificaci%C3%B3n_fiscal)).

```php
v::nif()->assert('49294492H');
// Validation passes successfully

v::nif()->assert('P6437358A');
// → "P6437358A" must be a valid NIF
```

## Templates

### `Nif::TEMPLATE_STANDARD`

| Mode       | Template                            |
| ---------- | ----------------------------------- |
| `default`  | {{subject}} must be a valid NIF     |
| `inverted` | {{subject}} must not be a valid NIF |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
| ------: | ----------- |
|   2.2.0 | Created     |

---

See also:

- [Bsn](Bsn.md)
- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
- [Hetu](Hetu.md)
- [PortugueseNif](PortugueseNif.md)
