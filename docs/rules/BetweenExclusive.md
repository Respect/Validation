# BetweenExclusive

- `BetweenExclusive(mixed $minimum, mixed $maximum)`

Validates whether the input is between two other values, exclusively.

```php
v::betweenExclusive(10, 20)->validate(10); // true
v::betweenExclusive('a', 'e')->validate('c'); // true
v::betweenExclusive(new DateTime('yesterday'), new DateTime('tomorrow'))->validate(new DateTime('today')); // true

v::betweenExclusive(0, 100)->validate(100); // false
v::betweenExclusive('a', 'z')->validate('a'); // false
```

Validation makes comparison easier, check out our supported [comparable values](../07-comparable-values.md).

## Categorization

- Comparisons

## Changelog

| Version | Description                 |
|--------:|-----------------------------|
|   3.0.0 | Created                     |

***
See also:

- [Between](Between.md)
- [DateTime](DateTime.md)
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [Min](Min.md)
