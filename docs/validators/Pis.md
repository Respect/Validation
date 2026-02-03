<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Bruno Koga <brunokoga187@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Pis

- `Pis()`

Validates a Brazilian PIS/NIS number ignoring any non-digit char.

```php
v::pis()->assert('120.0340.678-8');
// Validation passes successfully

v::pis()->assert('120.03406788');
// Validation passes successfully

v::pis()->assert('120.0340.6788');
// Validation passes successfully

v::pis()->assert('1.2.0.0.3.4.0.6.7.8.8');
// Validation passes successfully

v::pis()->assert('12003406788');
// Validation passes successfully
```

## Templates

### `Pis::TEMPLATE_STANDARD`

|       Mode | Template                                   |
| ---------: | :----------------------------------------- |
|  `default` | {{subject}} must be a valid PIS number     |
| `inverted` | {{subject}} must not be a valid PIS number |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
| ------: | :---------- |
|   2.0.0 | Created     |

## See Also

- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
