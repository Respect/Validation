# LessThanOrEqual

- `LessThanOrEqual(mixed $compareTo)`

Validates whether the input is less than or equal to a value.

```php
v::lessThanOrEqual(10)->validate(9); // true
v::lessThanOrEqual(10)->validate(10); // true
v::lessThanOrEqual(10)->validate(11); // false
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
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [LessThan](LessThan.md)
- [MaxAge](MaxAge.md)
- [Min](Min.md)
- [MinAge](MinAge.md)
