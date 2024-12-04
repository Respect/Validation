# Subset

- `Subset(array $superset)`

Validates whether the input is a subset of a given value.

```php
v::subset([1, 2, 3])->isValid([1, 2]); // true
v::subset([1, 2])->isValid([1, 2, 3]); // false
```

## Templates

`Subset::TEMPLATE_STANDARD`

| Mode       | Template                                    |
|------------|---------------------------------------------|
| `default`  | {{name}} must be subset of {{superset}}     |
| `inverted` | {{name}} must not be subset of {{superset}} |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |
| `superset`  |                                                                  |

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
