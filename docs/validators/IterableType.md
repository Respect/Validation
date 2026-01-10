# IterableType

- `IterableType()`

Validates whether the input is iterable, meaning that it matches the built-in compile time type alias `iterable`.

```php
v::iterableType()->assert([]);
// Validation passes successfully

v::iterableType()->assert(new ArrayObject());
// Validation passes successfully

v::iterableType()->assert(new stdClass());
// → `stdClass {}` must be iterable

v::iterableType()->assert('string');
// → "string" must be iterable
```

## Templates

### `IterableType::TEMPLATE_STANDARD`

| Mode       | Template                      |
| ---------- | ----------------------------- |
| `default`  | {{subject}} must be iterable  |
| `inverted` | {{subject}} must not iterable |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Types

## Changelog

| Version | Description                               |
| ------: | ----------------------------------------- |
|   3.0.0 | Rejected `stdClass` as iterable           |
|   1.0.8 | Renamed from `Iterable` to `IterableType` |
|   1.0.0 | Created as `Iterable`                     |

---

See also:

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Countable](Countable.md)
- [Each](Each.md)
- [Instance](Instance.md)
- [IterableVal](IterableVal.md)
- [Max](Max.md)
