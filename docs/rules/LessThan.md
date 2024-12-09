# LessThan

- `LessThan(mixed $compareTo)`

Validates whether the input is less than a value.

```php
v::lessThan(10)->isValid(9); // true
v::lessThan(10)->isValid(10); // false
```

Validation makes comparison easier, check out our supported
[comparable values](../08-comparable-values.md).

Message template for this validator includes `{{compareTo}}`.

## Templates

### `LessThan::TEMPLATE_STANDARD`

| Mode       | Template                                     |
|------------|----------------------------------------------|
| `default`  | {{name}} must be less than {{compareTo}}     |
| `inverted` | {{name}} must not be less than {{compareTo}} |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `compareTo` | Value to be compared against the input.                          |
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Comparisons

## Changelog

| Version | Description |
|--------:|-------------|
|   2.0.0 | Created     |

***
See also:

- [Between](Between.md)
- [BetweenExclusive](BetweenExclusive.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [Length](Length.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [Min](Min.md)
