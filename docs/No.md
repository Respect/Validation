# No

- `No()`
- `No(bool $locale)`

Validates if value is considered as "No".

```php
v::no()->validate('N'); // true
v::no()->validate('Nay'); // true
v::no()->validate('Nix'); // true
v::no()->validate('No'); // true
v::no()->validate('Nope'); // true
v::no()->validate('Not'); // true
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
