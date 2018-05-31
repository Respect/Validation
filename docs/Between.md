# Between

- `Between(mixed $minimum, mixed $maximum)`

Validates whether the input is between two other values.

```php
v::intVal()->between(10, 20)->validate(10); // true
v::intVal()->between(10, 20)->validate(15); // true
v::intVal()->between(10, 20)->validate(20); // true
```

Validation makes comparison easier, check out our supported 
[comparable values](ComparableValues.md).

Message template for this validator includes `{{minValue}}` and `{{maxValue}}`.

## Changelog

Version | Description
--------|-------------
  2.0.0 | Became always inclusive
  1.0.0 | Became inclusive by default
  0.3.9 | Created

***
See also:

- [GreaterThan](GreaterThan.md)
- [Length](Length.md)
- [LessThan](LessThan.md)
- [Max](Max.md)
- [Min](Min.md)
