# GreaterThanOrEqual

- `GreaterThanOrEqual(mixed $compareTo)`

Validates whether the input is greater than or equal to a value.

```php
v::intVal()->greaterThanOrEqual(10)->isValid(9); // false
v::intVal()->greaterThanOrEqual(10)->isValid(10); // true
v::intVal()->greaterThanOrEqual(10)->isValid(11); // true
```

Validation makes comparison easier, check out our supported
[comparable values](../08-comparable-values.md).

Message template for this validator includes `{{compareTo}}`.

## Templates

`GreaterThanOrEqual::TEMPLATE_STANDARD`

| Mode       | Template                                                |
|------------|---------------------------------------------------------|
| `default`  | {{name}} must be greater than or equal to {{compareTo}} |
| `inverted` | {{name}} must be less than {{compareTo}}                |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `compareTo` | Value to be compared against the input.                          |
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Comparisons

## Changelog

| Version | Description                                |
|--------:|--------------------------------------------|
|   3.0.0 | Renamed from "Min" to "GreaterThanOrEqual" |
|   2.0.0 | Became always inclusive                    |
|   1.0.0 | Became inclusive by default                |
|   0.3.9 | Created                                    |

***
See also:

- [Between](Between.md)
- [BetweenExclusive](BetweenExclusive.md)
- [GreaterThan](GreaterThan.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [Min](Min.md)
