# Identical

- `Identical(mixed $value)`

Validates if the input is identical to some value.

```php
v::identical(42)->isValid(42); // true
v::identical(42)->isValid('42'); // false
```

Message template for this validator includes `{{compareTo}}`.

## Templates

### `Identical::TEMPLATE_STANDARD`

| Mode       | Template                                           |
| ---------- | -------------------------------------------------- |
| `default`  | {{subject}} must be identical to {{compareTo}}     |
| `inverted` | {{subject}} must not be identical to {{compareTo}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `compareTo` | Value to be compared against the input.                          |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Comparisons

## Changelog

| Version | Description |
| ------: | ----------- |
|   1.0.0 | Created     |

---

See also:

- [Contains](Contains.md)
- [Equals](Equals.md)
- [Equivalent](Equivalent.md)
