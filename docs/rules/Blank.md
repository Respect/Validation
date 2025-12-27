# Blank

- `Blank()`

Validates if the given input is a blank value (`null`, zeros, empty strings or empty arrays, recursively).

```php
v::blank()->isValid(null); // true
v::blank()->isValid(''); // true
v::blank()->isValid([]); // true
v::blank()->isValid(' '); // true
v::blank()->isValid(0); // true
v::blank()->isValid('0'); // true
v::blank()->isValid(0); // true
v::blank()->isValid('0.0'); // true
v::blank()->isValid(false); // true
v::blank()->isValid(['']); // true
v::blank()->isValid([' ']); // true
v::blank()->isValid([0]); // true
v::blank()->isValid(['0']); // true
v::blank()->isValid([false]); // true
v::blank()->isValid([[''], [0]]); // true
v::blank()->isValid(new stdClass()); // true
```

It's similar to [NotEmpty](NotEmpty.md), but way stricter.

## Templates

### `Blank::TEMPLATE_STANDARD`

| Mode       | Template                      |
| ---------- | ----------------------------- |
| `default`  | {{subject}} must be blank     |
| `inverted` | {{subject}} must not be blank |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Miscellaneous

## Changelog

| Version | Description                                 |
| ------: | ------------------------------------------- |
|   3.0.0 | Renamed to `Blank` and changed the behavior |
|   1.0.0 | Created as `NotBlank`                       |

---

See also:

- [NotEmpty](NotEmpty.md)
- [NotUndef](NotUndef.md)
- [NoWhitespace](NoWhitespace.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [UndefOr](UndefOr.md)
