# Phone

- `Phone()`

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

| Mode       | Template                                         |
| ---------- | ------------------------------------------------ |
| `default`  | {{subject}} must be a valid telephone number     |
| `inverted` | {{subject}} must not be a valid telephone number |

### `Phone::TEMPLATE_FOR_COUNTRY`

| Mode       | Template                                                                                |
| ---------- | --------------------------------------------------------------------------------------- |
| `default`  | {{subject}} must be a valid telephone number for country {{countryName&#124;trans}}     |
| `inverted` | {{subject}} must not be a valid telephone number for country {{countryName&#124;trans}} |

## Template placeholders

| Placeholder   | Description                                                      |
| ------------- | ---------------------------------------------------------------- |
| `countryName` |                                                                  |
| `subject`     | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                       |
| ------: | --------------------------------- |
|   2.3.0 | Updated to use external validator |
|   0.5.0 | Created                           |

---

See also:

- [Email](Email.md)
- [Json](Json.md)
- [Url](Url.md)
- [VideoUrl](VideoUrl.md)
