# ScalarVal

- `ScalarVal()`

Validates whether the input is a scalar value or not.

```php
v::scalarVal()->isValid([]); // false
v::scalarVal()->isValid(135.0); // true
```

## Templates

### `ScalarVal::TEMPLATE_STANDARD`

| Mode       | Template                            |
|------------|-------------------------------------|
| `default`  | {{name}} must be a scalar value     |
| `inverted` | {{name}} must not be a scalar value |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Types

## Changelog

| Version | Description |
|--------:|-------------|
|   1.0.0 | Created     |

***
See also:

- [ArrayVal](ArrayVal.md)
- [NumericVal](NumericVal.md)
- [StringType](StringType.md)
- [Type](Type.md)
