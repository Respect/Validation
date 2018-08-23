# Min

- `Min(mixed $compareTo)`

Validates whether the input is greater than or equal to a value.

```php
v::intVal()->min(10)->validate(9); // false
v::intVal()->min(10)->validate(10); // true
v::intVal()->min(10)->validate(11); // true
```

Validation makes comparison easier, check out our supported 
[comparable values](ComparableValues.md).

Message template for this validator includes `{{compareTo}}`.

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
- [MaxAge](MaxAge.md)
- [MinAge](MinAge.md)
