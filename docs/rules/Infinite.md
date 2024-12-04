# Infinite

- `Infinite()`

Validates if the input is an infinite number.

```php
v::infinite()->isValid(INF); // true
```

## Templates

`Infinite::TEMPLATE_STANDARD`

| Mode       | Template                                |
|------------|-----------------------------------------|
| `default`  | {{name}} must be an infinite number     |
| `inverted` | {{name}} must not be an infinite number |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Math
- Numbers

## Changelog

| Version | Description |
|--------:|-------------|
|   1.0.0 | Created     |

***
See also:

- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [Factor](Factor.md)
- [Finite](Finite.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [NumericVal](NumericVal.md)
- [Type](Type.md)
