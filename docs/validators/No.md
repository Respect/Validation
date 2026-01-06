# No

- `No()`
- `No(bool $locale)`

Validates if value is considered as "No".

```php
v::no()->assert('N');
// Validation passes successfully

v::no()->assert('Nay');
// Validation passes successfully

v::no()->assert('Nix');
// Validation passes successfully

v::no()->assert('No');
// Validation passes successfully

v::no()->assert('Nope');
// Validation passes successfully

v::no()->assert('Not');
// Validation passes successfully
```

This validator is case insensitive.

If `$locale` is `TRUE`, it will use the value of [nl_langinfo][] with `NOEXPR`
constant, meaning that it will validate the input using your current location:

```php
setlocale(LC_ALL, 'ru_RU');
v::no(true)->assert('нет');
// Validation passes successfully
```

Be careful when using `$locale` as `TRUE` because the it's very permissive:

```php
v::no(true)->assert('Never gonna give you up 🎵');
// Validation passes successfully
```

Besides that, with `$locale` as `TRUE` it will consider any character starting
with "N" as valid:

```php
setlocale(LC_ALL, 'es_ES');
v::no(true)->assert('Yes');
// → "Yes" must be similar to "No"
```

## Templates

### `No::TEMPLATE_STANDARD`

| Mode       | Template                                |
| ---------- | --------------------------------------- |
| `default`  | {{subject}} must be similar to "No"     |
| `inverted` | {{subject}} must not be similar to "No" |

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
- [Yes](Yes.md)
