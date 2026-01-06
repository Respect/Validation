# Falsy

- `Falsy()`

Validates whether the given input is considered empty or falsy, similar to PHP's `empty()` function.

We recommend you to check [Comparing empty values](../comparing-empty-values.md) for more details.

```php
v::falsy()->assert('');
// Validation passes successfully
```

Null values are empty:

```php
v::falsy()->assert(null);
// Validation passes successfully
```

Numbers:

```php
v::falsy()->assert(0);
// Validation passes successfully
```

Empty arrays:

```php
v::falsy()->assert([]);
// Validation passes successfully
```

## Templates

### `Falsy::TEMPLATE_STANDARD`

| Mode       | Template                      |
| ---------- | ----------------------------- |
| `default`  | {{subject}} must be falsy     |
| `inverted` | {{subject}} must not be falsy |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Miscellaneous

## Changelog

| Version | Description                                 |
| ------: | ------------------------------------------- |
|   3.0.0 | Renamed to `Falsy` and changed the behavior |
|   0.3.9 | Created as `NotEmpty`                       |

---

See also:

- [Blank](Blank.md)
- [Each](Each.md)
- [Max](Max.md)
- [Min](Min.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [Spaced](Spaced.md)
- [Undef](Undef.md)
- [UndefOr](UndefOr.md)
