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

If `$locale` is `TRUE`, it will use the value of [nl_langinfo][] with `NOEXPR`
constant, meaning that it will validate the input using your current location:

```php
setlocale(LC_ALL, 'ru_RU');
v::no(true)->validate('нет'); // true
```

Be careful when using `$locale` as `TRUE` because the it's very permissive:

```php
v::no(true)->validate('Never gonna give you up 🎵'); // true
```

Besides that, with `$locale` as  `TRUE` it will consider any character starting
with "N" as valid:

```php
setlocale(LC_ALL, 'es_ES');
v::no(true)->validate('Yes'); // true
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
