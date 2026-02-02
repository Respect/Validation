<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
SPDX-FileContributor: Mazen Touati <mazen_touati@hotmail.com>
-->

# MacAddress

- `MacAddress()`

Validates whether the input is a valid MAC address.

```php
v::macAddress()->assert('00:11:22:33:44:55');
// Validation passes successfully

v::macAddress()->assert('af-AA-22-33-44-55');
// Validation passes successfully
```

## Templates

### `MacAddress::TEMPLATE_STANDARD`

|       Mode | Template                              |
| ---------: | :------------------------------------ |
|  `default` | {{subject}} must be a MAC address     |
| `inverted` | {{subject}} must not be a MAC address |

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
|   0.3.9 | Created           |

## See Also

- [Domain](Domain.md)
- [Iban](Iban.md)
- [Ip](Ip.md)
- [PublicDomainSuffix](PublicDomainSuffix.md)
- [Tld](Tld.md)
