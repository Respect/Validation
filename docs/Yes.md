# Yes

- `Yes()`
- `Yes(bool $locale)`

Validates if value is considered as "Yes".

```php
v::yes()->isValid('Y'); // true
v::yes()->isValid('Yea'); // true
v::yes()->isValid('Yeah'); // true
v::yes()->isValid('Yep'); // true
v::yes()->isValid('Yes'); // true
```

This rule is case insensitive.

If `$locale` is TRUE, uses the value of [nl_langinfo()](http://php.net/nl_langinfo) with `YESEXPR` constant.

## Changelog

Version | Description
--------|-------------
  0.7.0 | Created

***
See also:

- [No](No.md)
