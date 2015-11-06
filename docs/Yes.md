# Yes

- `v::yes()`
- `v::yes(boolean $locale)`

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

***
See also:

  * [No](No.md)
