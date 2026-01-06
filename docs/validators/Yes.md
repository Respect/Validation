# Yes

- `Yes()`
- `Yes(bool $locale)`

Validates if the input considered as "Yes".

```php
v::yes()->assert('Y');
// Validation passes successfully

v::yes()->assert('Yea');
// Validation passes successfully

v::yes()->assert('Yeah');
// Validation passes successfully

v::yes()->assert('Yep');
// Validation passes successfully

v::yes()->assert('Yes');
// Validation passes successfully
```

This validator is case insensitive.

If `$locale` is `TRUE`, it will use the value of [nl_langinfo][] with `YESEXPR`
constant, meaning that it will validate the input using your current location:

```php
setlocale(LC_ALL, 'pt_BR');
v::yes(true)->assert('Sim');
// Validation passes successfully
```

Be careful when using `$locale` as `TRUE` because the it's very permissive:

```php
v::yes(true)->assert('Yydoesnotmatter');
// Validation passes successfully
```

Besides that, with `$locale` as `TRUE` it will consider any character starting
with "Y" as valid:

```php
setlocale(LC_ALL, 'ru_RU');
v::yes(true)->assert('Yes');
// Validation passes successfully
```

## Templates

### `Yes::TEMPLATE_STANDARD`

| Mode       | Template                                 |
| ---------- | ---------------------------------------- |
| `default`  | {{subject}} must be similar to "Yes"     |
| `inverted` | {{subject}} must not be similar to "Yes" |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Booleans

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.7.0 | Created     |

---

See also:

- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [No](No.md)

[nl_langinfo]: http://php.net/nl_langinfo
