# Yes

- `Yes()`
- `Yes(bool $locale)`

Validates if the input considered as "Yes".

```php
v::yes()->isValid('Y'); // true
v::yes()->isValid('Yea'); // true
v::yes()->isValid('Yeah'); // true
v::yes()->isValid('Yep'); // true
v::yes()->isValid('Yes'); // true
```

This rule is case insensitive.

If `$locale` is `TRUE`, it will use the value of [nl_langinfo][] with `YESEXPR`
constant, meaning that it will validate the input using your current location:

```php
setlocale(LC_ALL, 'pt_BR');
v::yes(true)->isValid('Sim'); // true
```

Be careful when using `$locale` as `TRUE` because the it's very permissive:

```php
v::yes(true)->isValid('Yydoesnotmatter'); // true
```

Besides that, with `$locale` as  `TRUE` it will consider any character starting
with "Y" as valid:

```php
setlocale(LC_ALL, 'ru_RU');
v::yes(true)->isValid('Yes'); // true
```

## Templates

### `Yes::TEMPLATE_STANDARD`

| Mode       | Template                              |
|------------|---------------------------------------|
| `default`  | {{name}} must be similar to "Yes"     |
| `inverted` | {{name}} must not be similar to "Yes" |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Booleans

## Changelog

| Version | Description |
|--------:|-------------|
|   0.7.0 | Created     |

***
See also:

- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [No](No.md)

[nl_langinfo]: http://php.net/nl_langinfo
