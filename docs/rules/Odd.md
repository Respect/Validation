# Odd

- `Odd()`

Validates whether the input is an odd number or not.

```php
v::odd()->isValid(0); // false
v::odd()->isValid(3); // true
```

Using `intVal()` before `odd()` is a best practice.

## Templates

### `Odd::TEMPLATE_STANDARD`

| Mode       | Template                           |
| ---------- | ---------------------------------- |
| `default`  | {{subject}} must be an odd number  |
| `inverted` | {{subject}} must be an even number |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Numbers

## Changelog

| Version | Description             |
| ------: | ----------------------- |
|   2.0.0 | Only validates integers |
|   0.3.9 | Created                 |

---

See also:

- [Even](Even.md)
- [Multiple](Multiple.md)
