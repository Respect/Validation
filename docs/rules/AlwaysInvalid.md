# AlwaysInvalid

- `AlwaysInvalid()`

Validates any input as invalid.

```php
v::alwaysInvalid()->isValid('whatever'); // false
```

## Templates

### `AlwaysInvalid::TEMPLATE_STANDARD`

| Mode       | Template                    |
| ---------- | --------------------------- |
| `default`  | {{subject}} must be valid   |
| `inverted` | {{subject}} must be invalid |

### `AlwaysInvalid::TEMPLATE_SIMPLE`

| Mode       | Template               |
| ---------- | ---------------------- |
| `default`  | {{subject}} is invalid |
| `inverted` | {{subject}} is valid   |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Booleans

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.5.0 | Created     |

---

See also:

- [AlwaysValid](AlwaysValid.md)
- [When](When.md)
