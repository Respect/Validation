# LessThan

- `LessThan(mixed $compareTo)`

Validates whether the input is less than a value.

```php
v::lessThan(10)->validate(9); // true
v::lessThan(10)->validate(10); // false
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
