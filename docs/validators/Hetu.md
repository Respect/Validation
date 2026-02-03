<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
SPDX-FileContributor: Ville Hukkamäki <vhukkamaki@gmail.com>
-->

# Hetu

- `Hetu()`

Validates a Finnish personal identity code ([HETU][]).

```php
v::hetu()->assert('010106A9012');
// Validation passes successfully

v::hetu()->assert('290199-907A');
// Validation passes successfully

v::hetu()->assert('280291+923X');
// Validation passes successfully

v::hetu()->assert('010106_9012');
// → "010106_9012" must be a valid Finnish personal identity code
```

The validation is case-sensitive.

## Templates

### `Hetu::TEMPLATE_STANDARD`

|       Mode | Template                                                       |
| ---------: | :------------------------------------------------------------- |
|  `default` | {{subject}} must be a valid Finnish personal identity code     |
| `inverted` | {{subject}} must not be a valid Finnish personal identity code |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Identifications

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.0.0 | Created     |

## See Also

- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
- [Imei](Imei.md)
- [Nif](Nif.md)
- [PortugueseNif](PortugueseNif.md)

[HETU]: https://en.wikipedia.org/wiki/National_identification_number#Finland
