# IterableType

- `IterableType()`

Validates whether the input is iterable, meaning that it matches the built-in compile time type alias `iterable`.

```php
v::iterableType()->isValid([]); // true
v::iterableType()->isValid(new ArrayObject()); // true

v::iterableType()->isValid(new stdClass()); // false
v::iterableType()->isValid('string'); // false
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
