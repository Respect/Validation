# LanguageCode

- `v::languageCode()`

Validates a language code based on ISO 639:

```php
v::languageCode()->validate('pt'); // true
v::languageCode()->validate('en'); // true
v::languageCode()->validate('it'); // true
v::languageCode('alpha-3')->validate('ita'); // true
v::languageCode('alpha-3')->validate('eng'); // true
```

You can choose between alpha-2 and alpha-3, alpha-2 is set by default.

***
See also:

  * [CountryCode](CountryCode.md)
