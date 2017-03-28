# Yes

- `Yes()`
- `Yes(bool $locale)`

Validates if value is considered as "Yes".

```php
v::yes()->validate('Y'); // true
v::yes()->validate('Yea'); // true
v::yes()->validate('Yeah'); // true
v::yes()->validate('Yep'); // true
v::yes()->validate('Yes'); // true
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
