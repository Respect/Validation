# No

- `No()`
- `No(bool $locale)`

Validates if value is considered as "No".

```php
v::no()->isValid('N'); // true
v::no()->isValid('Nay'); // true
v::no()->isValid('Nix'); // true
v::no()->isValid('No'); // true
v::no()->isValid('Nope'); // true
v::no()->isValid('Not'); // true
```

This rule is case insensitive.

If `$locale` is TRUE, uses the value of [nl_langinfo()](http://php.net/nl_langinfo) with `NOEXPR` constant.

## Changelog

Version | Description
--------|-------------
  0.7.0 | Created

***
See also:

- [Yes](Yes.md)
