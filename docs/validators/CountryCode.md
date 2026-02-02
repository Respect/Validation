<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# CountryCode

- `CountryCode()`
- `CountryCode("alpha-2"|"alpha-3"|"numeric" $set)`

Validates whether the input is a country code in [ISO 3166-1][] standard.

**This validator requires [sokil/php-isocodes][] and [sokil/php-isocodes-db-only][] to be installed.**

```php
v::countryCode()->assert('BR');
// Validation passes successfully

v::countryCode('alpha-2')->assert('NL');
// Validation passes successfully

v::countryCode('alpha-3')->assert('USA');
// Validation passes successfully

v::countryCode('numeric')->assert('504');
// Validation passes successfully
```

This validator supports the three sets of country codes:

- ISO 3166-1 alpha-2: `alpha-2`
- ISO 3166-1 alpha-3: `alpha-3`
- ISO 3166-1 numeric: `numeric`

When no set is defined, the validator uses `'alpha-2'` (`CountryCode::ALPHA2`).

## Templates

### `CountryCode::TEMPLATE_STANDARD`

|       Mode | Template                               |
| ---------: | :------------------------------------- |
|  `default` | {{subject}} must be a country code     |
| `inverted` | {{subject}} must not be a country code |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- ISO codes
- Localization

## Changelog

| Version | Description                                                       |
| ------: | :---------------------------------------------------------------- |
|   3.0.0 | Templates changed                                                 |
|   3.0.0 | Require [sokil/php-isocodes][] and [sokil/php-isocodes-db-only][] |
|   2.0.0 | Became case-sensitive                                             |
|   0.5.0 | Created                                                           |

## See Also

- [CurrencyCode](CurrencyCode.md)
- [LanguageCode](LanguageCode.md)
- [PostalCode](PostalCode.md)
- [PublicDomainSuffix](PublicDomainSuffix.md)
- [SubdivisionCode](SubdivisionCode.md)
- [Tld](Tld.md)

[ISO 3166-1]: https://wikipedia.org/wiki/ISO_3166-1
[sokil/php-isocodes]: https://github.com/sokil/php-isocodes
[sokil/php-isocodes-db-only]: https://github.com/sokil/php-isocodes-db-only
