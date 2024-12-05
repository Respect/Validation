# Phone

- `Phone()`

Validates whether the input is a valid phone number. This rule requires
the `giggsey/libphonenumber-for-php-lite` package.


```php
v::phone()->isValid('+1 650 253 00 00'); // true
v::phone('BR')->isValid('+55 11 91111 1111'); // true
v::phone('BR')->isValid('11 91111 1111'); // false
```

## Templates

`Phone::TEMPLATE_INTERNATIONAL`

| Mode       | Template                                      |
|------------|-----------------------------------------------|
| `default`  | {{name}} must be a valid telephone number     |
| `inverted` | {{name}} must not be a valid telephone number |

`Phone::TEMPLATE_FOR_COUNTRY`

| Mode       | Template                                                                             |
|------------|--------------------------------------------------------------------------------------|
| `default`  | {{name}} must be a valid telephone number for country {{countryName&#124;trans}}     |
| `inverted` | {{name}} must not be a valid telephone number for country {{countryName&#124;trans}} |

## Template placeholders

| Placeholder   | Description                                                      |
|---------------|------------------------------------------------------------------|
| `countryName` |                                                                  |
| `name`        | The validated input or the custom validator name (if specified). |

## Categorization

- Strings

## Changelog

| Version | Description                       |
|--------:|-----------------------------------|
|   2.3.0 | Updated to use external validator |
|   0.5.0 | Created                           |

***
See also:

- [Email](Email.md)
- [Json](Json.md)
- [Url](Url.md)
- [VideoUrl](VideoUrl.md)
