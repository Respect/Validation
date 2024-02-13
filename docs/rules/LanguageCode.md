# LanguageCode

- `LanguageCode()`
- `LanguageCode("alpha-2"|"alpha-3" $set)`

Validates whether the input is language code based on [ISO 639][].

**This rule requires [sokil/php-isocodes][] and [sokil/php-isocodes-db-only][] to be installed.**

```php
v::languageCode()->validate('pt'); // true
v::languageCode()->validate('en'); // true
v::languageCode()->validate('it'); // true
v::languageCode('alpha-3')->validate('ita'); // true
v::languageCode('alpha-3')->validate('eng'); // true
```

This rule supports the two[ISO 639][] sets:

- `alpha-2`
- `alpha-3`

## Categorization

- ISO codes
- Localization

## Changelog

Version | Description
--------|-------------
  3.0.0 | Require [sokil/php-isocodes][] and [sokil/php-isocodes-db-only][]
  1.1.0 | Created

***
See also:

- [CountryCode](CountryCode.md)

[ISO 639]: https://en.wikipedia.org/wiki/ISO_639-3
[sokil/php-isocodes]: https://github.com/sokil/php-isocodes
[sokil/php-isocodes-db-only]: https://github.com/sokil/php-isocodes-db-only
