# LanguageCode

- `LanguageCode()`
- `LanguageCode(string $set)`

Validates whether the input is language code based on ISO 639.

```php
v::languageCode()->validate('pt'); // true
v::languageCode()->validate('en'); // true
v::languageCode()->validate('it'); // true
v::languageCode('alpha-3')->validate('ita'); // true
v::languageCode('alpha-3')->validate('eng'); // true
```

You can choose between `alpha-2` and `alpha-3`; `alpha-2` is set by default set.

This rule uses data from [sokil/php-isocodes][].

## Categorization

- ISO codes
- Localization

## Changelog

Version | Description
--------|-------------
  1.1.0 | Created

***
See also:

- [CountryCode](CountryCode.md)

[sokil/php-isocodes]: https://github.com/sokil/php-isocodes
