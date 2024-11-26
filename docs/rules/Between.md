# Between

- `Between(mixed $minimum, mixed $maximum)`

Validates whether the input is between two other values.

```php
use Respect\Validation\Validator as v;

v::intVal()->between(10, 20)->validate(10); // true
v::intVal()->between(10, 20)->validate(15); // true
v::intVal()->between(10, 20)->validate(20); // true
```

Validation makes comparison easier, check out our supported
[comparable values](../07-comparable-values.md).

Message template for this validator includes `{{minValue}}` and `{{maxValue}}`.

## Categorization

- Comparisons

## Changelog

Version | Description
--------|-------------
  2.0.0 | Became always inclusive
  1.0.0 | Became inclusive by default
  0.3.9 | Created

***
See also:

- [BetweenExclusive](BetweenExclusive.md)
- [DateTime](DateTime.md)
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [Min](Min.md)
