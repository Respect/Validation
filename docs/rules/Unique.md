# Unique

- `Unique()`

Validates whether the input array contains only unique values.

```php
v::unique()->isValid([]); // true
v::unique()->isValid([1, 2, 3]); // true
v::unique()->isValid([1, 2, 2, 3]); // false
v::unique()->isValid([1, 2, 3, 1]); // false
```

## Templates

`Unique::TEMPLATE_STANDARD`

| Mode       | Template                             |
|------------|--------------------------------------|
| `default`  | {{name}} must not contain duplicates |
| `inverted` | {{name}} must contain duplicates     |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays

## Changelog

| Version | Description |
|--------:|-------------|
|   2.0.0 | Created     |

***
See also:

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Contains](Contains.md)
- [Each](Each.md)
