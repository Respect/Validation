# Negative

- `Negative()`

Validates whether the input is a negative number.

```php
v::numericVal()->negative()->assert(-15);
// Validation passes successfully
```

## Templates

### `Negative::TEMPLATE_STANDARD`

| Mode       | Template                                  |
| ---------- | ----------------------------------------- |
| `default`  | {{subject}} must be a negative number     |
| `inverted` | {{subject}} must not be a negative number |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Math
- Numbers

## Changelog

| Version | Description                          |
| ------: | ------------------------------------ |
|   2.0.0 | Does not validate non-numeric values |
|   0.3.9 | Created                              |

---

See also:

- [Positive](Positive.md)
