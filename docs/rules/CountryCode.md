# CountryCode

- `CountryCode()`
- `CountryCode("alpha-2"|"alpha-3"|"numeric" $set)`

Validates whether the input is a country code in [ISO 3166-1][] standard.

**This rule requires [sokil/php-isocodes][] and [sokil/php-isocodes-db-only][] to be installed.**

```php
v::countryCode()->isValid('BR'); // true

v::countryCode('alpha-2')->isValid('NL'); // true
v::countryCode('alpha-3')->isValid('USA'); // true
v::countryCode('numeric')->isValid('504'); // true
```

This rule supports the three sets of country codes:

- ISO 3166-1 alpha-2: `alpha-2`
- ISO 3166-1 alpha-3: `alpha-3`
- ISO 3166-1 numeric: `numeric`

When no set is defined, the rule uses `'alpha-2'` (`CountryCode::ALPHA2`).

## Templates

`CountryCode::TEMPLATE_STANDARD`

| Mode       | Template                                  |
|------------|-------------------------------------------|
| `default`  | {{name}} must be a valid country code     |
| `inverted` | {{name}} must not be a valid country code |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- ISO codes
- Localization

## Changelog

| Version | Description                                                       |
|--------:|-------------------------------------------------------------------|
|   3.0.0 | Require [sokil/php-isocodes][] and [sokil/php-isocodes-db-only][] |
|   2.0.0 | Became case-sensitive                                             |
|   0.5.0 | Created                                                           |

***
See also:

- [CurrencyCode](CurrencyCode.md)
- [LanguageCode](LanguageCode.md)
- [PostalCode](PostalCode.md)
- [PublicDomainSuffix](PublicDomainSuffix.md)
- [SubdivisionCode](SubdivisionCode.md)
- [Tld](Tld.md)

[ISO 3166-1]: https://wikipedia.org/wiki/ISO_3166-1
[sokil/php-isocodes]: https://github.com/sokil/php-isocodes
[sokil/php-isocodes-db-only]: https://github.com/sokil/php-isocodes-db-only
