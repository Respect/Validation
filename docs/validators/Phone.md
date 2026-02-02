<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Phone

- `Phone()`
- `Phone(string $countryCode)`

Validates whether the input is a valid phone number. This validator requires
the `giggsey/libphonenumber-for-php-lite` package.

```php
v::phone()->assert('+1 650 253 00 00');
// Validation passes successfully

v::phone('BR')->assert('+55 11 91111 1111');
// Validation passes successfully

v::phone('BR')->assert('11 91111 1111');
// Validation passes successfully
```

## Templates

### `Phone::TEMPLATE_INTERNATIONAL`

|       Mode | Template                               |
| ---------: | :------------------------------------- |
|  `default` | {{subject}} must be a phone number     |
| `inverted` | {{subject}} must not be a phone number |

### `Phone::TEMPLATE_FOR_COUNTRY`

|       Mode | Template                                                                      |
| ---------: | :---------------------------------------------------------------------------- |
|  `default` | {{subject}} must be a phone number for country {{countryName&#124;trans}}     |
| `inverted` | {{subject}} must not be a phone number for country {{countryName&#124;trans}} |

## Template placeholders

| Placeholder   | Description                                                      |
| ------------- | ---------------------------------------------------------------- |
| `countryName` |                                                                  |
| `subject`     | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                       |
| ------: | :-------------------------------- |
|   3.0.0 | Templates changed                 |
|   2.3.0 | Updated to use external validator |
|   0.5.0 | Created                           |

## See Also

- [Email](Email.md)
- [Json](Json.md)
- [Url](Url.md)
