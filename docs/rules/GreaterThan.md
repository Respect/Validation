# GreaterThan

- `GreaterThan(mixed $compareTo)`

Validates whether the input is greater than a value.

```php
v::greaterThan(10)->validate(11); // true
v::greaterThan(10)->validate(9); // false
```

Validation makes comparison easier, check out our supported 
[comparable values](ComparableValues.md).

Message template for this validator includes `{{compareTo}}`.

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Between](Between.md)
- [Max](Max.md)
- [Min](Min.md)
