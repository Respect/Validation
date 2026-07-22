# BetweenExclusive

- `BetweenExclusive(mixed $minimum, mixed $maximum)`

Validates whether the input is between two other values, excluding the boundaries.

```php
v::intVal()->betweenExclusive(10, 20)->isValid(15); // true
v::intVal()->betweenExclusive(10, 20)->isValid(10); // false
v::intVal()->betweenExclusive(10, 20)->isValid(20); // false
```

Validation makes comparison easier, check out our supported
[comparable values](../07-comparable-values.md).

Message template for this validator includes `{{minValue}}` and `{{maxValue}}`.

## Categorization

- Comparisons

## Changelog

Version | Description
--------|-------------
  2.5.0 | Created

***
See also:

- [Between](Between.md)
- [GreaterThan](GreaterThan.md)
- [LessThan](LessThan.md)
- [Max](Max.md)
- [Min](Min.md)
