<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# NfeAccessKey

- `NfeAccessKey()`

Validates the access key of the Brazilian electronic invoice (NFe).

```php
v::nfeAccessKey()->assert('52060433009911002506550120000007800267301615');
// Validation passes successfully

v::nfeAccessKey()->assert('31841136830118868211870485416765268625116906');
// → "31841136830118868211870485416765268625116906" must be a NFe access key
```

## Templates

### `NfeAccessKey::TEMPLATE_STANDARD`

|       Mode | Template                                 |
| ---------: | :--------------------------------------- |
|  `default` | {{subject}} must be a NFe access key     |
| `inverted` | {{subject}} must not be a NFe access key |

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
|   0.6.0 | Created           |

## See Also

- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
