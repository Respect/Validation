# Finite

- `Finite()`

Validates if the input is a finite number.

```php
v::finite()->isValid('10'); // true
v::finite()->isValid(10); // true
```

## Templates

### `Finite::TEMPLATE_STANDARD`

| Mode       | Template                             |
|------------|--------------------------------------|
| `default`  | {{name}} must be a finite number     |
| `inverted` | {{name}} must not be a finite number |

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
- [Infinite](Infinite.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [NumericVal](NumericVal.md)
- [Type](Type.md)
