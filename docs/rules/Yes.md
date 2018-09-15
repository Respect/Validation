# Yes

- `Yes()`
- `Yes(bool $locale)`

Validates if the input considered as "Yes".

```php
v::yes()->validate('Y'); // true
v::yes()->validate('Yea'); // true
v::yes()->validate('Yeah'); // true
v::yes()->validate('Yep'); // true
v::yes()->validate('Yes'); // true
```

This rule is case insensitive.

If `$locale` is `TRUE`, it will use the value of [nl_langinfo][] with `YESEXPR`
constant, meaning that it will validate the input using your current location:

```php
setlocale(LC_ALL, 'pt_BR');
v::yes(true)->validate('Sim'); // true
```

Be careful when using `$locale` as `TRUE` because the it's very permissive:

```php
v::yes(true)->validate('Yydoesnotmatter'); // true
```

Besides that, with `$locale` as  `TRUE` it will consider any character starting
with "Y" as valid:

```php
setlocale(LC_ALL, 'ru_RU');
v::yes(true)->validate('Yes'); // true
```

## Changelog

Version | Description
--------|-------------
  0.7.0 | Created

***
See also:

- [No](No.md)

[nl_langinfo]: http://php.net/nl_langinfo
