# IntType

- `IntType()`

Validates whether the type of a value is integer.

```php
v::intType()->validate(42); // true
v::intType()->validate('10'); // false
```

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [BoolType](BoolType.md)
- [CallableType](CallableType.md)
- [Digit](Digit.md)
- [Finite](Finite.md)
- [FloatType](FloatType.md)
- [Infinite](Infinite.md)
- [IntVal](IntVal.md)
- [NullType](NullType.md)
- [NumericVal](NumericVal.md)
- [ObjectType](ObjectType.md)
- [ResourceType](ResourceType.md)
- [StringType](StringType.md)
- [Type](Type.md)
