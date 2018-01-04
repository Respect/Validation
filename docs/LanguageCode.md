# LanguageCode

- `LanguageCode()`

Validates a language code based on ISO 639:

```php
v::languageCode()->isValid('pt'); // true
v::languageCode()->isValid('en'); // true
v::languageCode()->isValid('it'); // true
v::languageCode('alpha-3')->isValid('ita'); // true
v::languageCode('alpha-3')->isValid('eng'); // true
```

You can choose between alpha-2 and alpha-3, alpha-2 is set by default.

## Changelog

Version | Description
--------|-------------
  1.1.0 | Created

***
See also:

- [CountryCode](CountryCode.md)
