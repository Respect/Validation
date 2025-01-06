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

If `$locale` is `TRUE`, it will use the value of [nl_langinfo][] with `NOEXPR`
constant, meaning that it will validate the input using your current location:

```php
setlocale(LC_ALL, 'ru_RU');
v::no(true)->isValid('нет'); // true
```

Be careful when using `$locale` as `TRUE` because the it's very permissive:

```php
v::no(true)->isValid('Never gonna give you up 🎵'); // true
```

Besides that, with `$locale` as  `TRUE` it will consider any character starting
with "N" as valid:

```php
setlocale(LC_ALL, 'es_ES');
v::no(true)->isValid('Yes'); // true
```

## Categorization

- Booleans

## Changelog

Version | Description
--------|-------------
  0.7.0 | Created

***
See also:

- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [Yes](Yes.md)
