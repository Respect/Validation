<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
SPDX-FileContributor: Mazen Touati <mazen_touati@hotmail.com>
-->

# PostalCode

- `PostalCode(string $countryCode)`
- `PostalCode(string $countryCode, bool $formatted)`

Validates whether the input is a valid postal code or not.

```php
v::postalCode('BR')->assert('02179000');
// Validation passes successfully

v::postalCode('BR')->assert('02179-000');
// Validation passes successfully

v::postalCode('US')->assert('02179-000');
// → "02179-000" must be a valid postal code on "US"

v::postalCode('US')->assert('55372');
// Validation passes successfully

v::postalCode('PL')->assert('99-300');
// Validation passes successfully
```

By default, `PostalCode` won't validate the format (puncts, spaces), unless you pass `$formatted = true`:

```php
v::postalCode('BR', true)->assert('02179000');
// → "02179000" must be a valid postal code on "BR"

v::postalCode('BR', true)->assert('02179-000');
// Validation passes successfully
```

Message template for this validator includes `{{countryCode}}`.

Extracted from [GeoNames](http://www.geonames.org/).

## Templates

### `PostalCode::TEMPLATE_STANDARD`

|       Mode | Template                                                       |
| ---------: | :------------------------------------------------------------- |
|  `default` | {{subject}} must be a valid postal code on {{countryCode}}     |
| `inverted` | {{subject}} must not be a valid postal code on {{countryCode}} |

## Template placeholders

| Placeholder   | Description                                                      |
| ------------- | ---------------------------------------------------------------- |
| `countryCode` |                                                                  |
| `subject`     | The validated input or the custom validator name (if specified). |

## Categorization

- Localization
- Strings

## Changelog

| Version | Description                                       |
| ------: | :------------------------------------------------ |
|   2.3.0 | Add option to validate formatting                 |
|   2.2.4 | Cambodian postal codes now support 5 and 6 digits |
|   0.7.0 | Created                                           |

## See Also

- [CountryCode](CountryCode.md)
- [Iban](Iban.md)
