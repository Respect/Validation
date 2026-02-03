<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# CurrencyCode

- `CurrencyCode()`
- `CurrencyCode("alpha-3"|"numeric" $set)`

Validates an [ISO 4217][] currency code.

**This validator requires [sokil/php-isocodes][] and [sokil/php-isocodes-db-only][] to be installed.**

```php
v::currencyCode()->assert('GBP');
// Validation passes successfully
```

This validator supports the two [ISO 4217][] sets:

- `alpha-3`
- `numeric`

## Templates

### `CurrencyCode::TEMPLATE_STANDARD`

|       Mode | Template                                      |
| ---------: | :-------------------------------------------- |
|  `default` | {{subject}} must be a valid currency code     |
| `inverted` | {{subject}} must not be a valid currency code |

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
|   3.0.0 | Require [sokil/php-isocodes][] and [sokil/php-isocodes-db-only][] |
|   2.0.0 | Became case-sensitive                                             |
|   1.0.0 | Created                                                           |

## See Also

- [CountryCode](CountryCode.md)
- [SubdivisionCode](SubdivisionCode.md)

[ISO 4217]: http://en.wikipedia.org/wiki/ISO_4217
[sokil/php-isocodes]: https://github.com/sokil/php-isocodes
[sokil/php-isocodes-db-only]: https://github.com/sokil/php-isocodes-db-only
