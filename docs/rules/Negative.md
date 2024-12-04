# Negative

- `Negative()`

Validates whether the input is a negative number.

```php
v::numericVal()->negative()->isValid(-15); // true
```

## Templates

`Negative::TEMPLATE_STANDARD`

| Mode       | Template                               |
|------------|----------------------------------------|
| `default`  | {{name}} must be a negative number     |
| `inverted` | {{name}} must not be a negative number |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Math
- Numbers

## Changelog

| Version | Description                          |
|--------:|--------------------------------------|
|   2.0.0 | Does not validate non-numeric values |
|   0.3.9 | Created                              |

***
See also:

- [Positive](Positive.md)
