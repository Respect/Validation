<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Diego Oliveira <contato@diegoholiveira.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
SPDX-FileContributor: Ville Hukkamäki <vhukkamaki@gmail.com>
-->

# Imei

- `Imei()`

Validates is the input is a valid [IMEI][].

```php
v::imei()->assert('35-209900-176148-1');
// Validation passes successfully

v::imei()->assert('490154203237518');
// Validation passes successfully
```

## Templates

### `Imei::TEMPLATE_STANDARD`

|       Mode | Template                                    |
| ---------: | :------------------------------------------ |
|  `default` | {{subject}} must be a valid IMEI number     |
| `inverted` | {{subject}} must not be a valid IMEI number |

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

- [Bsn](Bsn.md)
- [Cnh](Cnh.md)
- [Cnpj](Cnpj.md)
- [Cpf](Cpf.md)
- [Hetu](Hetu.md)
- [Isbn](Isbn.md)
- [Luhn](Luhn.md)

[IMEI]: https://en.wikipedia.org/wiki/International_Mobile_Station_Equipment_Identity "International Mobile Station Equipment Identity"
