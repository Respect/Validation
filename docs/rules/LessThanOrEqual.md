# LessThanOrEqual

- `LessThanOrEqual(mixed $compareTo)`

Validates whether the input is less than or equal to a value.

```php
v::lessThanOrEqual(10)->isValid(9); // true
v::lessThanOrEqual(10)->isValid(10); // true
v::lessThanOrEqual(10)->isValid(11); // false
```

Validation makes comparison easier, check out our supported
[comparable values](../07-comparable-values.md).

Message template for this validator includes `{{compareTo}}`.

## Categorization

- Comparisons

## Changelog

| Version | Description                             |
|--------:|-----------------------------------------|
|   3.0.0 | Renamed from "Max" to "LessThanOrEqual" |
|   2.0.0 | Became always inclusive                 |
|   1.0.0 | Became inclusive by default             |
|   0.3.9 | Created                                 |

***
See also:

- [Between](Between.md)
- [BetweenExclusive](BetweenExclusive.md)
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [Max](Max.md)
- [Min](Min.md)
