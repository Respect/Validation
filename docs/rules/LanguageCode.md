# LanguageCode

- `LanguageCode()`
- `LanguageCode("alpha-2"|"alpha-3" $set)`

Validates whether the input is language code based on [ISO 639][].

**This rule requires [sokil/php-isocodes][] and [sokil/php-isocodes-db-only][] to be installed.**

```php
v::languageCode()->isValid('pt'); // true
v::languageCode()->isValid('en'); // true
v::languageCode()->isValid('it'); // true
v::languageCode('alpha-3')->isValid('ita'); // true
v::languageCode('alpha-3')->isValid('eng'); // true
```

This rule supports the two[ISO 639][] sets:

- `alpha-2`
- `alpha-3`

## Templates

`LanguageCode::TEMPLATE_STANDARD`

| Mode       | Template                                   |
|------------|--------------------------------------------|
| `default`  | {{name}} must be a valid language code     |
| `inverted` | {{name}} must not be a valid language code |

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
|   1.1.0 | Created                                                           |

***
See also:

- [CountryCode](CountryCode.md)

[ISO 639]: https://en.wikipedia.org/wiki/ISO_639-3
[sokil/php-isocodes]: https://github.com/sokil/php-isocodes
[sokil/php-isocodes-db-only]: https://github.com/sokil/php-isocodes-db-only
