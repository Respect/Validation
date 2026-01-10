# GreaterThan

- `GreaterThan(mixed $compareTo)`

Validates whether the input is greater than a value.

```php
v::greaterThan(10)->assert(11);
// Validation passes successfully

v::greaterThan(10)->assert(9);
// → 9 must be greater than 10
```

Validation makes comparison easier, check out our supported
[comparable values](../comparable-values.md).

Message template for this validator includes `{{compareTo}}`.

## Templates

### `GreaterThan::TEMPLATE_STANDARD`

| Mode       | Template                                           |
| ---------- | -------------------------------------------------- |
| `default`  | {{subject}} must be greater than {{compareTo}}     |
| `inverted` | {{subject}} must not be greater than {{compareTo}} |

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
|   2.0.0 | Created     |

---

See also:

- [Between](Between.md)
- [BetweenExclusive](BetweenExclusive.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [Length](Length.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [Min](Min.md)
